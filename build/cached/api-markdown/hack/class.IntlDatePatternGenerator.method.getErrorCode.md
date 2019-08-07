``` yamlmeta
{
    "name": "getErrorCode",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/icu/ext_icu_date_pattern_gen.php"
    ],
    "class": "IntlDatePatternGenerator"
}
```




Get last error code on the object







``` Hack
public function getErrorCode(): int;
```




## Returns




+ ` int ` - - An ICU error code indicating either success, failure
  or a warning.
<!-- HHAPIDOC -->
