<?php
namespace craft\plugins\mnmatchinput\fields;

use Craft;
use craft\app\fields\PlainText;

class MatchInput extends PlainText
{
	// Static
	// =========================================================================

	/**
	 * @inheritdoc
	 */
	public static function displayName()
	{
		return Craft::t('app', 'Match Input');
	}

	public static function validateRegex($regex)
	{
		set_error_handler(function() { return true; }, E_NOTICE);
		$valid = (preg_match($regex, '') !== false);
		restore_error_handler();

		return $valid;
	}


	// Properties
	// =========================================================================

	/**
	 * @var string The input’s inputMask text
	 */
	public $inputMask;

	/**
	 * @var string The input’s errorMessage text
	 */
	public $errorMessage;

	// Public Methods
	// =========================================================================

	/**
	 * @inheritdoc
	 */
	public function getSettingsHtml()
	{
		return Craft::$app->getView()->renderTemplate('mnmatchinput/settings', [
			'field' => $this
		]);
	}


	/**
	 * @inheritdoc
	 */
	public function getInputHtml($value, $element)
	{
		return Craft::$app->getView()->renderTemplate('mnmatchinput/input', [
			'name'  => $this->handle,
			'value' => $value,
			'field' => $this,
		]);
	}

	/**
	 * @inheritdoc
	 */
	public function validateValue($value, $element)
	{
		// get any current errors
		$errors = parent::validate($value);

		if (!is_array($errors))
		{
			$errors = [];
		}

		if ($value !== '')
		{ // for blank fields, we defer to required or not
			$inputMask = $this->inputMask;

			$match = preg_match($inputMask, $value);

			if ($match !== 1)
			{
				$errors[] = Craft::t('app', $this->errorMessage);
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

	public function validate($attributeNames = NULL, $clearErrors = true)
	{
		$validates = parent::validate($attributeNames, $clearErrors);
		if (!self::validateRegex($this->inputMask))
		{
			$this->addError('inputMask', Craft::t('app', 'Not a valid regex (missing delimiters?)'));
			$validates = false;
		}
		return $validates;
	}

}
