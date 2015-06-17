craft-mn_matchinput
===================

Craft field type for text fields that match a regex pattern

**Installation**

- Unzip file
- Place the 'mnmatchinput' folder into your craft/plugins directory
- Install plugin in the Craft Control Panel under Settings > Plugins

**Usage**

When you create the field, you specify the `Input Mask`. This is a [PCRE Pattern](http://php.net/manual/en/pcre.pattern.php). The pattern must _include the delimiter_. You also specify an `Error Message` to display if the field does not match.

**Examples**

- `http://` - not a valid pattern (no delimiters)
- `/http:\/\//` - valid pattern, will match string with `http://` in it anywhere
- `#http://#` - valid pattern, will match string with `http://` in it anywhere (sometimes `/` isn't the best delimiter)
- `#^http://#` - will match string that begins with `http://`
- `/^\d{5}(-\d{4})?$/` - will match 5 digits, optionally followed by - and 4 digits (uses ^ and $ to match the entire string)

**Change Log**

- 3.0: Craft 3 version. See master branch for Craft 2 version.
- 2.0: Custom error message for failure to match. Checks for valid regex, and will not save field if regex is invalid. Does not validate blank fields.
- 1.0: Initial release