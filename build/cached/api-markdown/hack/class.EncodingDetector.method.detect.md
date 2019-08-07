``` yamlmeta
{
    "name": "detect",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/icu/ext_icu_ucsdet.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_icu_ucsdet.hhi"
    ],
    "class": "EncodingDetector"
}
```




Returns an EncodingMatch object containing the best guess
for the encoding of the byte array




``` Hack
public function detect(): EncodingMatch;
```




## Returns




+ ` object ` - EncodingMatch
<!-- HHAPIDOC -->
