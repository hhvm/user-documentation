``` yamlmeta
{
    "name": "icu_transliterate",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/icu/ext_icu.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_icu.hhi"
    ]
}
```




``` Hack
function icu_transliterate(
  string $str,
  bool $remove_accents,
): string;
```




## Parameters




+ ` string $str `
+ ` bool $remove_accents `




## Returns




* ` string `
<!-- HHAPIDOC -->
