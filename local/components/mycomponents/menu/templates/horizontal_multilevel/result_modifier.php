<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
foreach($arResult["ITEMS_DESC"] as &$arItem)
{
	if( !empty($arItem['PICTURE']) )
	{
		$pictureID = $arItem['PICTURE'];
		$picture = CFile::ResizeImageGet(
			$pictureID, 
			array("width" => 194, "height" => 194), 
			BX_RESIZE_IMAGE_PROPORTIONAL, 
			false, 
			array(), 
			false, 
			100
		);
		$arItem['PICTURE'] = $picture['src'];
		
	}
}
?>