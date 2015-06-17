<?php
namespace Craft;

require_once('MnMatchInput_ValidRegexValidator.php');

class MnMatchInput_SettingsModel extends BaseModel
{
	public function rules()
	{
		$rules = parent::rules();
		$rules[] = array('inputMask', 'Craft\MnMatchInput_ValidRegexValidator');

		return $rules;
	}

	protected function defineAttributes()
	{
		return array(
			'errorMessage'     => array(AttributeType::String),
			'inputMask'     => array(AttributeType::String),
			'placeholder'   => array(AttributeType::String),
			'multiline'     => array(AttributeType::Bool),
			'initialRows'   => array(AttributeType::Number, 'min' => 1, 'default' => 4),
			'maxLength'     => array(AttributeType::Number, 'min' => 0),
		);
	}
}
