``` yamlmeta
{
    "name": "getErrorMessage",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/icu/ext_icu_date_pattern_gen.php"
    ],
    "class": "IntlDatePatternGenerator"
}
```




Get last error message on the object







``` Hack
public function getErrorMessage(): string;
```




## Returns




+ ` string ` - - The error message associated with last error that
  occurred in a function call on this object, or a string indicating
  the non-existence of an error.
<!-- HHAPIDOC -->
