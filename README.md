craft-mn_matchinput
===================

Craft field type for text fields that match a regex pattern

**Installation**

- Unzip file
- Place the 'mnmatchinput' folder into your craft/plugins directory
- Install plugin in the Craft Control Panel under Settings > Plugins

**Usage**

When you create the field, you specify the `Input Mask`. This is a [PCRE Pattern](http://php.net/manual/en/pcre.pattern.php). If the `Input Mask` is not a valid pattern (probably because you forgot the delimiters), you will get a php error when you try to save an entry with that field.

**Examples**

- `http://` - not a valid pattern (no delimiters), you will get a php error
- `/http:\/\//` - valid pattern, will match string with `http://` in it anywhere
- `#http://#` - valid pattern, will match string with `http://` in it anywhere (sometimes / isn't the best delimiter)
- `#^http://#` - will match string that begins with `http://`
- `/^\d{5}(-\d{4})?$/` - will match 5 digits, optionally followed by - and 4 digits (uses ^ and $ to match the entire string)