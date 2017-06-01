<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Loader;
use Bitrix\Iblock;
if (!Loader::includeModule('iblock'))
	return;
$arIBlock = array();
$iblockFilter = (
	!empty($arCurrentValues['IBLOCK_TYPE'])
	? array('TYPE' => $arCurrentValues['IBLOCK_TYPE'], 'ACTIVE' => 'Y')
	: array('ACTIVE' => 'Y')
);
$rsIBlock = CIBlock::GetList(array('SORT' => 'ASC'), $iblockFilter);
while ($arr = $rsIBlock->Fetch())
	$arIBlock[$arr['ID']] = '['.$arr['ID'].'] '.$arr['NAME'];
unset($arr, $rsIBlock, $iblockFilter);
$arComponentParameters = array(
	"GROUPS" => array(),
	"PARAMETERS" => array(
		"IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("MYMENU_IBLOCK"),
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "N",
			"VALUES" => $arIBlock,
			"REFRESH" => "N",
		),	
		"DEPTH_LEVEL" => Array(
			"NAME"=>GetMessage("MYMENU_DEPTH_LEVEL"),
			"TYPE" => "LIST",
			"DEFAULT"=>'2',
			"PARENT" => "BASE",
			"VALUES" => Array(
				2 => "2",
				3 => "3",
			),
			"ADDITIONAL_VALUES"	=> "N",
		),
		"SHOW_POPULAR" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("MYMENU_POPULAR"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N"
		),	

	)
);
?>
