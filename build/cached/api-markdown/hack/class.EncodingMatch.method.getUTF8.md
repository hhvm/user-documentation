``` yamlmeta
{
    "name": "getUTF8",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/icu/ext_icu_ucsdet.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_icu_ucsdet.hhi"
    ],
    "class": "EncodingMatch"
}
```




Gets the UTF-8 encoded version of the encoded byte array







``` Hack
public function getUTF8(): string;
```




## Returns




+ ` string ` - - The result of converting the bytes to UTF-8
  with the detected encoding
<!-- HHAPIDOC -->
