``` yamlmeta
{
    "name": "setDecimal",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/icu/ext_icu_date_pattern_gen.php"
    ],
    "class": "IntlDatePatternGenerator"
}
```




The decimal value is used in formatting fractions of seconds




``` Hack
public function setDecimal(
  string $decimal,
): void;
```




If the skeleton contains fractional seconds, then this is used with the
fractional seconds. For example, suppose that the input pattern is
"hhmmssSSSS", and the best matching pattern internally is "H:mm:ss", and
the decimal string is ",". Then the resulting pattern is modified to be
"H:mm:ss,SSSS"




## Parameters




+ ` string $decimal ` - The string to represent the decimal




## Returns




* ` void `
<!-- HHAPIDOC -->
