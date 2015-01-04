<?php
namespace Craft;

/**
 * MN Match Input
 *
 * @package   Craft
 * @author    Marion Newlevant
 * @copyright Copyright (c) 2015, Marion Newlevant
 * @license   MIT
 * @link      https://github.com/marionnewlevant/craft-mn_matchinput
 */

class MnMatchInputPlugin extends BasePlugin
{
	function getName()
	{
		return Craft::t('MN Match Input');
	}

	function getVersion()
	{
		return '1.0';
	}

	function getDeveloper()
	{
		return 'Marion Newlevant';
	}

	function getDeveloperUrl()
	{
		return 'http://marion.newlevant.com';
	}
}
