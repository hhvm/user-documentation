``` yamlmeta
{
    "name": "getPatternForSkeleton",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/icu/ext_icu_date_pattern_gen.php"
    ],
    "class": "IntlDatePatternGenerator"
}
```




Get the pattern corresponding to a given skeleton




``` Hack
public function getPatternForSkeleton(
  string $skeleton,
): string;
```




## Parameters




+ ` string $skeleton ` - The skeleton is a pattern containing only the
  variable fields. For example, "MMMdd" and "mmhh" are skeletons.




## Returns




* ` string ` - - pattern
<!-- HHAPIDOC -->
