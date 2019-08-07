``` yamlmeta
{
    "name": "replaceFieldTypes",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/icu/ext_icu_date_pattern_gen.php"
    ],
    "class": "IntlDatePatternGenerator"
}
```




Adjusts the field types (width and subtype) of a pattern to match what is
in a skeleton




``` Hack
public function replaceFieldTypes(
  string $pattern,
  string $skeleton,
): string;
```




Example: given an input pattern of "d-M H:m", and a skeleton of
"MMMMddhhmm", the output pattern will be "dd-MMMM hh:mm".




## Parameters




+ ` string $pattern ` - Input pattern
+ ` string $skeleton ` - The skeleton is a pattern containing only the
  variable fields. For example, "MMMdd" and "mmhh" are skeletons.




## Returns




* ` string ` - - Pattern adjusted to match the skeleton fields widths and
  subtypes.
<!-- HHAPIDOC -->
