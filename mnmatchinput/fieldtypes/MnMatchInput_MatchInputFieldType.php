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

		if ($value != '')
		{
			// skip for empty fields. If they are not ok, set required
			$inputMask = $this->getSettings()->inputMask;

			$match = preg_match($inputMask, $value);

			if ($match !== 1)
			{
				$errors[] = $this->getSettings()->errorMessage ?: 'Does not match pattern';
			}
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

	protected function getSettingsModel()
	{
		return new MnMatchInput_SettingsModel();
	}

}
