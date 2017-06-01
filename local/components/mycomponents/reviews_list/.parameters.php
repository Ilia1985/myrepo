<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
	"GROUPS" => array(),
	"PARAMETERS" => array(
		"REVIEW_TYPE" => Array(
			"NAME" => GetMessage("MYREVIEWS_LIST_REVIEW_TYPE"),
			"TYPE" => "LIST",
			"DEFAULT" => "page",
			"PARENT" => "BASE",
			"VALUES" => Array(
				"page" => "Для текущей страницы",
				"element" => "Для элемента инфоблока",
			),
			"ADDITIONAL_VALUES"	=> "N",
			"REFRESH" => "Y",
		),


	)
);
if( $arCurrentValues["REVIEW_TYPE"] == "element" )
{
	$arComponentParameters["PARAMETERS"]["ELEMENT_ID"] = Array(
		"PARENT" => "BASE",
		"NAME" => GetMessage("MYREVIEWS_LIST_ELEMENT_ID"),
		"TYPE" => "STRING",
	);
}	
?>
