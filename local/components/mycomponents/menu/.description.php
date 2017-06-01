<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("MYMENU_MENU_ITEMS_NAME"),
	"DESCRIPTION" => GetMessage("MYMENU_MENU_ITEMS_DESC"),
	"PATH" => array(
		"ID" => "utility",
		"CHILD" => array(
			"ID" => "mynavigation",
			"NAME" => GetMessage("MYMENU_NAVIGATION_SERVICE")
		)
	),
);

?>