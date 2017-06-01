<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(!CModule::IncludeModule("highloadblock"))
	return;
$arErrors = Array();
if( file_exists($_SERVER['DOCUMENT_ROOT']."/".$this->GetPath()."/functions.php") )
{
	require_once("functions.php");
	$HLBlockName = 'MyReviewsTbl';	
	if(  $HLBlockID = chechHLBlock($HLBlockName) )
	{
		$arHLBlock = Bitrix\Highloadblock\HighloadBlockTable::getById($HLBlockID)->fetch();
		$obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
		$strEntityDataClass = $obEntity->getDataClass();
		$linkValue = null;
		if( $arParams['REVIEW_TYPE'] == 'page')
		{
			if( !empty($arParams['CUR_PAGE']) )
				$linkValue = $arParams['CUR_PAGE'];
			else				
				$linkValue = $APPLICATION->GetCurPage(); 
		}
		else if( isset($arParams['ELEMENT_ID']) )
		{
			$linkValue =  intval($arParams['ELEMENT_ID']);
		}		
		
		$rsData = $strEntityDataClass::getList(array(
			'filter' => array('=UF_LINK' => $linkValue), 
			'select' => array('ID', 'UF_AUTOR', 'UF_DATA', 'UF_TEXT'),
			'order' =>  array('UF_DATA' => 'DESC'),
			'limit' => '10',
		));
		while ($arItem = $rsData->Fetch()) 
		{
			$arResult['ITEMS'][] = $arItem;
		}
	}
	
}
else
	$arErrors[] = "functions.php - not found";
if( !empty($arErrors) )
	echo '<pre>',print_r($arErrors),'</pre>';
$this->IncludeComponentTemplate();
?>

