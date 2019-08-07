``` yamlmeta
{
    "name": "setDeclaredEncoding",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/icu/ext_icu_ucsdet.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_icu_ucsdet.hhi"
    ],
    "class": "EncodingDetector"
}
```




If the user provided an encoding in metadata
(like an HTTP or XML declaration),
this can be used as an additional hint to the detector




``` Hack
public function setDeclaredEncoding(
  string $encoding,
): void;
```




## Parameters




+ ` string $encoding ` - Possible encoding for the byte array obtained
  from associated metadata




## Returns




* ` void `
<!-- HHAPIDOC -->
