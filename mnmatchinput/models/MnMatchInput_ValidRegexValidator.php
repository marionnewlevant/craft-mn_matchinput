<?php
namespace Craft;

class MnMatchInput_ValidRegexValidator extends \CValidator
{
	// Protected Methods
	// =========================================================================

	/**
	 * @param $object
	 * @param $attribute
	 *
	 * @return null
	 */
	protected function validateAttribute($object, $attribute)
	{
		$regex = $object->$attribute;

		set_error_handler(function() { return true; }, E_NOTICE);
		$isValid = preg_match($regex, '') !== false;
		restore_error_handler();

		if (!$isValid)
		{
					$message = Craft::t('“{regex}” is not a valid Regex (did you forget the delimiters?)', array('regex' => $regex));
					$this->addError($object, $attribute, $message);
		}
	}
}
