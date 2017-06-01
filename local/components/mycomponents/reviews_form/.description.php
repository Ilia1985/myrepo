<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("MYREVIEWS_FORM_NAME"),
	"DESCRIPTION" => GetMessage("MYREVIEWS_FORM_DESC"),
	"PATH" => array(
		"ID" => "content",
		"CHILD" => array(
			"ID" => "myreviews",
			"NAME" => GetMessage("MYREVIEWS")
		)
	),
);

?>