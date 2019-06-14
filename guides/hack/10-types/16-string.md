The string type, `string`, is used to represent a sequence of zero or more characters. Conceptually, a string can be considered as an array of
characters -- the *elements* -- whose keys are the `int` values starting at zero. The type of each element is `string`. A string whose length is zero
is an *empty string*.

A *numeric string* is a string containing the following: optional leading whitespace, followed by an optional sign, followed by a base-10 integer
or floating-point number. A *leading-numeric string* is a string whose initial characters follow the requirements of a numeric string, and whose
trailing characters are non-numeric. A *non-numeric string* is a string that is not a numeric string. For example:

```Hack
""              // empty string
"Hello"         // string containing 5 characters
" -123"         // numeric string
'2e+5'          // numeric string
```

Consider the following example:

@@ string-examples/__toString.php @@

Method [`__toString`](../classes/methods-with-predefined-semantics.md#method-__toString) has a return type of `string`. The return expression results in
the concatenation of the three string literals and the two `float` property values into a single string.

`'('`, `','`, `')'`, `"\$p1 = "`, and `"\n"` are examples of string literals.

Here is a list of library functions for manipulating strings:

Name | Description
-----|------------
`HH\Lib\Str\capitalize` | Returns the string with the first character capitalized
`HH\Lib\Str\capitalize_words` | Returns the string with all words capitalized
`HH\Lib\Str\chunk` | Returns a vec containing the string split into chunks of the given size
`HH\Lib\Str\compare` | Returns < 0 if `$string1` is less than `$string2`, > 0 if `$string1` is greater than $string2, and 0 if they are equal
`HH\Lib\Str\compare_ci` | Returns < 0 if `$string1` is less than `$string2`, > 0 if `$string1` is greater than `$string2`, and 0 if they are equal (case-insensitive)
`HH\Lib\Str\contains` | Returns whether the "haystack" string contains the "needle" string
`HH\Lib\Str\contains_ci` | Returns whether the "haystack" string contains the "needle" string (case-insensitive)
`HH\Lib\Str\ends_with` | Returns whether the string ends with the given suffix
`HH\Lib\Str\ends_with_ci` | Returns whether the string ends with the given suffix (case-insensitive)
`HH\Lib\Str\format` | Given a valid format string (defined by `SprintfFormatString`), return a formatted string using `$format_args`
`HH\Lib\Str\format_number` | Returns a string representation of the given number with grouped thousands
`HH\Lib\Str\is_empty` | Returns whether the input is null or the empty string
`HH\Lib\Str\join` | Returns a string formed by joining the elements of the Traversable with the given `$glue` string
`HH\Lib\Str\length` | Returns the length of the given string
`HH\Lib\Str\lowercase` | Returns the string with all alphabetic characters converted to lowercase
`HH\Lib\Str\pad_left` | Returns the string padded to the total length by appending the `$pad_string` to the left
`HH\Lib\Str\pad_right` | Returns the string padded to the total length by appending the `$pad_string` to the right
`HH\Lib\Str\repeat` | Returns the input string repeated `$multiplier` times
`HH\Lib\Str\replace` | Returns the "haystack" string with all occurrences of `$needle` replaced by `$replacement`
`HH\Lib\Str\replace_ci` | Returns the "haystack" string with all occurrences of `$needle` replaced by `$replacement` (case-insensitive)
`HH\Lib\Str\replace_every` | Returns the "haystack" string with all occurrences of the keys of `$replacements` replaced by the corresponding values
`HH\Lib\Str\reverse` | Returns the input string reversed
`HH\Lib\Str\search` | Returns the first position of the "needle" string in the "haystack" string, or null if it isn't found
`HH\Lib\Str\search_ci` | Returns the first position of the "needle" string in the "haystack" string, or null if it isn't found (case-insensitive)
`HH\Lib\Str\search_last` | Returns the last position of the "needle" string in the "haystack" string, or null if it isn't found
`HH\Lib\Str\split` | Returns a vec containing the string split on the given delimiter
`HH\Lib\Str\slice` | Returns a substring of length `$length` of the given string starting at the `$offset`
`HH\Lib\Str\strip_prefix` | Returns the string with the given prefix removed, or the string itself if it doesn't start with the prefix
`HH\Lib\Str\strip_suffix` | Returns the string with the given suffix removed, or the string itself if it doesn't end with the suffix
`HH\Lib\Str\starts_with` | Returns whether the string starts with the given prefix
`HH\Lib\Str\starts_with_ci` | Returns whether the string starts with the given prefix (case-insensitive)
`HH\Lib\Str\trim` | Returns the given string with whitespace stripped from the beginning and end
`HH\Lib\Str\trim_left` | Returns the given string with whitespace stripped from the left
`HH\Lib\Str\trim_right` | Returns the given string with whitespace stripped from the right
`HH\Lib\Str\splice` | Return the string with a slice specified by the offset/length replaced by the given replacement string
`HH\Lib\Str\to_int` | Returns the given string as an integer, or null if the string isn't numeric
`HH\Lib\Str\uppercase` | Returns the string with all alphabetic characters converted to uppercase
