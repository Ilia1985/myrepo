<?
class CHLBlock
{
	var $errors = null;
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
	function createHLBlock($HLBlockName)
	{
		$result = Bitrix\Highloadblock\HighloadBlockTable::add(array(
			'NAME' => $HLBlockName,
			'TABLE_NAME' => strtolower($HLBlockName),
		));
		if (!$result->isSuccess()) {
			$this->errors = $result->getErrorMessages();
			return false;
		} else {
			return $result->getId();
		}		
	}
	function createHLBlockFields($hlBlockId, $fildName, $fieldType, $description, 
		$description_en, $size = 20, $rows = 1)
	{
		$userTypeEntity = new CUserTypeEntity();	 
		$userTypeData = array(
			'ENTITY_ID'         => 'HLBLOCK_'.$hlBlockId,
			'FIELD_NAME'        => 'UF_'.$fildName,
			'USER_TYPE_ID'      => $fieldType,
			'XML_ID'            => 'XML_ID_'.$fildName,
			'SORT'              => 500,
			'MULTIPLE'          => 'N',
			'MANDATORY'         => 'Y',
			'SHOW_FILTER'       => 'N',
			'SHOW_IN_LIST'      => '',
			'EDIT_IN_LIST'      => '',
			'IS_SEARCHABLE'     => 'N',
			'SETTINGS'          => array(
				'DEFAULT_VALUE' => 'empty',
				'SIZE'          => $size,
				'ROWS'          => $rows,
				'MIN_LENGTH'    => '0',
				'MAX_LENGTH'    => '0',
				'REGEXP'        => '',
			),
			'EDIT_FORM_LABEL'   => array(
				'ru'    => $description,
				'en'    => $description_en,
			),
			'LIST_COLUMN_LABEL' => array(
				'ru'    => $description,
				'en'    => $description_en,
			),
			'LIST_FILTER_LABEL' => array(
				'ru'    => $description,
				'en'    => $description_en,
			),
			'ERROR_MESSAGE'     => array(
				'ru'    => 'Ошибка при заполнении пользовательского свойства',
				'en'    => 'An error in completing the user field',
			),
			'HELP_MESSAGE'      => array(
				'ru'    => '',
				'en'    => '',
			),
		);
		if( $userTypeId = $userTypeEntity->Add($userTypeData))
		{
			return $userTypeId;
		}
		else
		{
			$this->errors = "Error: Can not create ".$fildName." field";
			return false;			
		}
	}
	 	
}		

?>