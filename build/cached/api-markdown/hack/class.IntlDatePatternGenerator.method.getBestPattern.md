``` yamlmeta
{
    "name": "getBestPattern",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/icu/ext_icu_date_pattern_gen.php"
    ],
    "class": "IntlDatePatternGenerator"
}
```




Returns the best pattern matching the input skeleton




``` Hack
public function getBestPattern(
  string $skeleton,
): string;
```




It is guaranteed to have all of the fields in the skeleton.




## Parameters




+ ` string $skeleton ` - The skeleton is a pattern containing only the
  variable fields. For example, "MMMdd" and "mmhh" are skeletons.




## Returns




* ` string ` - - The best pattern found for the given skeleton
<!-- HHAPIDOC -->
