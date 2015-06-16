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
  	@$valid = (preg_match($regex, '') !== false);
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
	      // you might think printing out the pattern that failed to match
	      // here would be helpful, but all you get is unfriendly regex.
	      // Just looks like random cartoon swearing
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

  public function beforeSave()
  {
  	return self::validateRegex($this->inputMask);
  }

}
