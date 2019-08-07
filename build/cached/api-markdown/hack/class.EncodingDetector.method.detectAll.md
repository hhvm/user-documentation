``` yamlmeta
{
    "name": "detectAll",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/icu/ext_icu_ucsdet.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_icu_ucsdet.hhi"
    ],
    "class": "EncodingDetector"
}
```




Returns an array of EncodingMatch objects containing all guesses
for the encoding of the byte array







``` Hack
public function detectAll(): array<EncodingMatch>;
```




## Returns




+ ` array<EncodingMatch> ` - - Array of EncodingMatch objects for all
  guesses of the encoding of the byte array
<!-- HHAPIDOC -->
