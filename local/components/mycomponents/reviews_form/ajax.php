<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if(!CModule::IncludeModule("highloadblock"))
	return;
if( empty($_POST['review_type']))
	return;
global $APPLICATION;
$arErrors = Array();
if( file_exists("CHLBlock.php") )
{
	require_once("CHLBlock.php");
	$HLBlock = new CHLBlock();
	$HLBlockName = 'MyReviewsTbl';	
	if(  $HLBlockID = $HLBlock->chechHLBlock($HLBlockName) )
	{
		//Подготовка:
 	    $arHLBlock = Bitrix\Highloadblock\HighloadBlockTable::getById($HLBlockID)->fetch();
		$obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
		$strEntityDataClass = $obEntity->getDataClass();
		$linkValue = null;
		if( $_POST['review_type'] == 'page')
		{
			$linkValue = $_POST['cur_page']; 
		}
		else if( isset($_POST['element_id']) )
		{
			$linkValue =  intval($_POST['element_id']);
		}
		$autor = trim(strip_tags($_POST['autor']));
		if( empty($autor) )
			$arErrors[] = "Автор не указан";	
		if( empty($text) )
			$arErrors[] = "Текст не указан";		
		$text = trim(strip_tags($_POST['text']));
		//Добавление:
		if( empty($arErrors) )
		{
			$arElementFields = array(
				'UF_AUTOR' => $autor,
				'UF_DATA' => new \Bitrix\Main\Type\DateTime,
				'UF_TEXT' => $text,
				'UF_LINK' => $linkValue,			
			);
			$obResult = $strEntityDataClass::add($arElementFields);
			$bSuccess = $obResult->isSuccess();
			if( !$bSuccess )
				$arErrors[] = "Can not add new item";
		}
	}
	else
		$arErrors[] = "HiloadBlock MyReviewsTbl - not found";
}
else
	$arErrors[] = "CHLBlock.php - not found";
$arReturn = Array();
$arReturn['errors'] = $arErrors;
?>
<?
if( $_POST['reviews_list_refresh'] == 'Y')
{
	ob_start(); 
	$APPLICATION->IncludeComponent(
		"mycomponents:reviews_list", 
		"list", 
		array(
			"REVIEW_TYPE" => $_POST['review_type'],
			"COMPONENT_TEMPLATE" => "list",
			"ELEMENT_ID" => $_POST['element_id'],
			"AJAX_CALL" => "Y",
			"CUR_PAGE" => $_POST['cur_page']  
		),
		false
	);
	$arReturn['html'] = ob_get_clean();
}
echo json_encode($arReturn);
?>

