<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(!CModule::IncludeModule("highloadblock"))
	return;
$arErrors = Array();
global $APPLICATION;
$arResult['CUR_PAGE'] = $APPLICATION->GetCurPage();
if( file_exists($_SERVER['DOCUMENT_ROOT']."/".$this->GetPath()."/CHLBlock.php") )
{
	require_once("CHLBlock.php");
	$HLBlock = new CHLBlock();
	$HLBlockName = 'MyReviewsTbl';	
	if(  !$HLBlock->chechHLBlock($HLBlockName) )
	{
		if( $HLBlockID = $HLBlock->createHLBlock($HLBlockName) )
		{
			if( !$HLBlock->createHLBlockFields($HLBlockID, 'LINK', 'string', 'ID элемента|URL страницы', 'ID|URL'))
				$arErrors[] = $HLBlock->errors;		
			if( !$HLBlock->createHLBlockFields($HLBlockID, 'TEXT', 'string', 'Текст', 'Text', 50, 10))
				$arErrors[] = $HLBlock->errors;
			if( !$HLBlock->createHLBlockFields($HLBlockID, 'DATA',  'datetime', 'Дата', 'Date'))
				$arErrors[] = $HLBlock->errors;

			if( !$HLBlock->createHLBlockFields($HLBlockID, 'AUTOR', 'string', 'Автор', 'Autor'))
				$arErrors[] = $HLBlock->errors;
		}
		else
		{
			$arErrors[] = $HLBlock->errors;
		}
	}
}
else
	$arErrors[] = "CHLBlock.php - not found";
if( !empty($arErrors) )
	echo '<pre>',print_r($arErrors),'</pre>';
$this->IncludeComponentTemplate();
?>

