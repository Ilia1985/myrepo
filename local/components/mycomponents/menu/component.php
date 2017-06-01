<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(!CModule::IncludeModule("iblock"))
	return;
$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);
$arParams["DEPTH_LEVEL"] = intval($arParams["DEPTH_LEVEL"]);
$arFilter = array(
	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	"GLOBAL_ACTIVE" => "Y",
	"IBLOCK_ACTIVE" => "Y",
	"<="."DEPTH_LEVEL" => $arParams["DEPTH_LEVEL"],
);
$arOrder = array(
	"left_margin" => "asc",
);

$rsSections = CIBlockSection::GetList($arOrder, $arFilter, false, array(
	"ID",
	"DEPTH_LEVEL",
	"NAME",
	"SECTION_PAGE_URL",
));

while($arSection = $rsSections->GetNext())
{
	$arResult["SECTIONS"][$arSection["ID"]] = array(
		"ID" => $arSection["ID"],
		"DEPTH_LEVEL" => $arSection["DEPTH_LEVEL"],
		"TEXT" => $arSection["~NAME"],
		"LINK" => $arSection["~SECTION_PAGE_URL"],
	);
}
$arPreviousSection = null;
$previousDepthLevel = 1;
$arFilter = array(
	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	"INCLUDE_SUBSECTIONS" => "Y",
);
foreach($arResult["SECTIONS"] as &$arSection)
{
	if($arSection["DEPTH_LEVEL"] > $previousDepthLevel)
		$arPreviousSection["IS_PARENT"] = true;
	$arPreviousSection = &$arSection;
	$previousDepthLevel = $arSection["DEPTH_LEVEL"];
    if( $arParams['SHOW_POPULAR'] == 'Y' )
	{
		$arFilter['SECTION_ID'] = $arSection['ID'];
		$res = CIBlockElement::GetList( 
			Array("SHOW_COUNTER" => "DESC"), 
			$arFilter, 
			false, 
			Array("nTopCount" => 1), 
			Array("IBLOCK_ID", "ID", "NAME", "SHOW_COUNTER", "PREVIEW_PICTURE", "DETAIL_PICTURE", "DETAIL_PAGE_URL")
		);
		if($ar_fields = $res->GetNext())
		{
			$arResult["ITEMS_DESC"][$arSection['ID']] = Array(
				"NAME" => $ar_fields["NAME"],
				"SHOW_COUNTER" => $ar_fields["SHOW_COUNTER"],
				"PICTURE" => ( (!empty($ar_fields["PREVIEW_PICTURE"]))? $ar_fields["PREVIEW_PICTURE"]:$ar_fields["DETAIL_PICTURE"]),
				"DETAIL_PAGE_URL" => $ar_fields["DETAIL_PAGE_URL"],
				"SHOW_COUNTER" => ( !empty($ar_fields["SHOW_COUNTER"])? $ar_fields["SHOW_COUNTER"] : 0 ),
			);
		}
	}

}

$this->IncludeComponentTemplate();
?>

