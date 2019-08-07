``` yamlmeta
{
    "name": "getAppendItemFormat",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/icu/ext_icu_date_pattern_gen.php"
    ],
    "class": "IntlDatePatternGenerator"
}
```




``` Hack
public function getAppendItemFormat(
  int $field,
): string;
```




## Parameters




+ ` int $field ` - Pattern field (see constants)




## Returns




* ` string ` - - Append item format for the given pattern field
<!-- HHAPIDOC -->
