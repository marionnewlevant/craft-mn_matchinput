craft-mn_matchinput
===================

***This is the old location of the Craft 2 version. This repo is going away - what you should use is the v1 branch of craft-match_input***

Craft field type for text fields that match a regex pattern

**Installation**

- Unzip file
- Place the 'mnmatchinput' folder into your craft/plugins directory
- Install plugin in the Craft Control Panel under Settings > Plugins

**Usage**

When you create the field, you specify the `Input Mask`. This is a [PCRE Pattern](http://php.net/manual/en/pcre.pattern.php). You also specify an `Error Message` to display when the field does not match the pattern

**Examples**

- `http://` - not a valid pattern (no delimiters)
- `/http:\/\//` - valid pattern, will match string with `http://` in it anywhere
- `#http://#` - valid pattern, will match string with `http://` in it anywhere (sometimes / isn't the best delimiter)
- `#^http://#` - will match string that begins with `http://`
- `/^\d{5}(-\d{4})?$/` - will match 5 digits, optionally followed by - and 4 digits (uses ^ and $ to match the entire string)

**Change Log**

- 2.0: Always accept blank input. Appropriate error message (rather than php error) for invalid regex. Custom error message for when field does not match pattern.
- 1.0: Initial release
