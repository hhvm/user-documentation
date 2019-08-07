``` yamlmeta
{
    "name": "createInstance",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/icu/ext_icu_date_pattern_gen.php"
    ],
    "class": "IntlDatePatternGenerator"
}
```




Creates a flexible generator according to the data for a given locale




``` Hack
public static function createInstance(
  string $locale,
): IntlDatePatternGenerator;
```




## Parameters




+ ` string $locale ` - Data will be loaded into the generator for the
  locale specified.




## Returns




* ` IntlDatePatternGenerator `
<!-- HHAPIDOC -->
