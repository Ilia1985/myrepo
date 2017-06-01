<?
function chechHLBlock($HLBlockName)
{
	$rsData = \Bitrix\Highloadblock\HighloadBlockTable::getList(
		array(
			'filter' => array('NAME' => $HLBlockName)
		)
	);
	if( $hldata = $rsData->fetch() )
	{
		return (int)$hldata['ID'];
	}
	else
	{
		return false;
	}

}
?>