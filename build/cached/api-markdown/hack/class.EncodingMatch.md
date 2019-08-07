``` yamlmeta
{
    "name": "EncodingMatch",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/icu/ext_icu_ucsdet.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_icu_ucsdet.hhi"
    ],
    "class": "EncodingMatch"
}
```




Result of detecting the encoding of an array of bytes




## Interface Synopsis




``` Hack
class EncodingMatch {...}
```




### Public Methods




+ [` ->getConfidence(): int `](</hack/reference/class/EncodingMatch/getConfidence/>)\
  Gets the confidence number of the encoding match

+ [` ->getEncoding(): string `](</hack/reference/class/EncodingMatch/getEncoding/>)\
  Gets the name of the detected encoding

+ [` ->getLanguage(): string `](</hack/reference/class/EncodingMatch/getLanguage/>)\
  Gets a rough guess at the language of the encoded bytes

+ [` ->getUTF8(): string `](</hack/reference/class/EncodingMatch/getUTF8/>)\
  Gets the UTF-8 encoded version of the encoded byte array

+ [` ->isValid(): bool `](</hack/reference/class/EncodingMatch/isValid/>)\
  Checks if the encoding match succeeded








### Private Methods




* [` ->__construct(): void `](</hack/reference/class/EncodingMatch/__construct/>)\
  Internal only: Creates an encoding match
<!-- HHAPIDOC -->
