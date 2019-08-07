``` yamlmeta
{
    "name": "addPattern",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/icu/ext_icu_date_pattern_gen.php"
    ],
    "class": "IntlDatePatternGenerator"
}
```




Adds a pattern to the generator




``` Hack
public function addPattern(
  string $pattern,
  bool $override,
): int;
```




If the pattern has the same skeleton as an existing pattern, and the
override parameter is set, then the previous value is overridden.
Otherwise, the previous value is retained.
Note that single-field patterns (like "MMM") are automatically added, and
don't need to be added explicitly!




## Parameters




+ ` string $pattern ` - Input pattern, such as "dd/MMM"
+ ` bool $override ` - When existing values are to be overridden use true,
  otherwise use false.




## Returns




* ` int ` - - pattern conflict status (see constants)
<!-- HHAPIDOC -->
