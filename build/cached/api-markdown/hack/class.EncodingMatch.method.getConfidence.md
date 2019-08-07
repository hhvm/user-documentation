``` yamlmeta
{
    "name": "getConfidence",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/icu/ext_icu_ucsdet.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_icu_ucsdet.hhi"
    ],
    "class": "EncodingMatch"
}
```




Gets the confidence number of the encoding match







``` Hack
public function getConfidence(): int;
```




## Returns




+ ` int ` - - Confidence number from 0 (no confidence) to 100
  (100 == complete confidence)
<!-- HHAPIDOC -->
