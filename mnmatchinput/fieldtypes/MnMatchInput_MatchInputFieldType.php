<?php
namespace Craft;

class MnMatchInput_MatchInputFieldType extends BaseFieldType
{
	public function getName()
	{
		return Craft::t('Match Input');
	}


	public function getSettingsHtml()
	{
		return craft()->templates->render('mnmatchinput/matchinput/settings', array(
			'settings' => $this->getSettings()
		));
	}

	public function defineContentAttribute()
	{
		$maxLength = $this->getSettings()->maxLength;

		if (!$maxLength)
		{
			$columnType = ColumnType::Text;
		}
		else
		{
			$columnType = DbHelper::getTextualColumnTypeByContentLength($maxLength);
		}

		return array(AttributeType::String, 'column' => $columnType, 'maxLength' => $maxLength);
	}

	public function getInputHtml($name, $value)
	{
		return craft()->templates->render('mnmatchinput/matchinput/input', array(
			'name'  => $name,
			'value' => $value,
			'settings' => $this->getSettings()
		));
	}

	public function validate($value)
	{
		// get any current errors
		$errors = parent::validate($value);

		if (!is_array($errors))
		{
			$errors = array();
		}

		$inputMask = $this->getSettings()->inputMask;

		$match = preg_match($inputMask, $value);

		if ($match !== 1)
		{
			$errors[] = Craft::t('Value did not match pattern.');
		}

		if ($errors)
		{
			return $errors;
		}
		else
		{
			return true;
		}
	}

	// Protected Methods
	// =========================================================================

	protected function defineSettings()
	{
		return array(
			'inputMask'     => array(AttributeType::String),
			'placeholder'   => array(AttributeType::String),
			'multiline'     => array(AttributeType::Bool),
			'initialRows'   => array(AttributeType::Number, 'min' => 1, 'default' => 4),
			'maxLength'     => array(AttributeType::Number, 'min' => 0),
		);
	}

}
