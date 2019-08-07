``` yamlmeta
{
    "name": "getSkeleton",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/icu/ext_icu_date_pattern_gen.php"
    ],
    "class": "IntlDatePatternGenerator"
}
```




Utility to return a unique skeleton from a given pattern




``` Hack
public function getSkeleton(
  string $pattern,
): string;
```




For example, both "MMM-dd" and "dd/MMM" produce the skeleton "MMMdd".




## Parameters




+ ` string $pattern ` - Input pattern, such as "dd/MMM"




## Returns




* ` string ` - - skeleton such as "MMMdd"
<!-- HHAPIDOC -->
