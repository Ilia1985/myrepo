<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("MYREVIEWS_LIST_NAME"),
	"DESCRIPTION" => GetMessage("MYREVIEWS_LIST_DESC"),
	"PATH" => array(
		"ID" => "content",
		"CHILD" => array(
			"ID" => "myreviews",
			"NAME" => GetMessage("MYREVIEWS")
		)
	),
);

?>