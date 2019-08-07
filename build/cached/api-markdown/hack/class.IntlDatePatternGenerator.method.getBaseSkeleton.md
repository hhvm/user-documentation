``` yamlmeta
{
    "name": "getBaseSkeleton",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/icu/ext_icu_date_pattern_gen.php"
    ],
    "class": "IntlDatePatternGenerator"
}
```




Utility to return a unique base skeleton from a given pattern




``` Hack
public function getBaseSkeleton(
  string $pattern,
): string;
```




This is the same as the skeleton, except that differences in length are
minimized so as to only preserve the difference between string and numeric
form. So for example, both "MMM-dd" and "d/MMM" produce the skeleton "MMMd"
(notice the single d).




## Parameters




+ ` string $pattern ` - Input pattern, such as "dd/MMM"




## Returns




* ` string ` - - base skeleton, such as "Md"
<!-- HHAPIDOC -->
