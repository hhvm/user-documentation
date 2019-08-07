``` yamlmeta
{
    "name": "setAppendItemName",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/icu/ext_icu_date_pattern_gen.php"
    ],
    "class": "IntlDatePatternGenerator"
}
```




Sets the name of a field, eg "era" in English for ERA




``` Hack
public function setAppendItemName(
  int $field,
  string $name,
): void;
```




These are only used if the corresponding AppendItemFormat is used, and if
it contains a {2} variable.




## Parameters




+ ` int $field ` - Pattern field (see constants)
+ ` string $name ` - Name of the field




## Returns




* ` void `
<!-- HHAPIDOC -->
