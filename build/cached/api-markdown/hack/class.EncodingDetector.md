``` yamlmeta
{
    "name": "EncodingDetector",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/icu/ext_icu_ucsdet.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_icu_ucsdet.hhi"
    ],
    "class": "EncodingDetector"
}
```




Guesses the encoding of an array of bytes in an
unknown encoding




http://icu-project.org/apiref/icu4c/ucsdet_8h.html




## Interface Synopsis




``` Hack
class EncodingDetector {...}
```




### Public Methods




+ [` ->__construct(): void `](</hack/reference/class/EncodingDetector/__construct/>)\
  Creates an encoding detector

+ [` ->detect(): EncodingMatch `](</hack/reference/class/EncodingDetector/detect/>)\
  Returns an EncodingMatch object containing the best guess
  for the encoding of the byte array

+ [` ->detectAll(): array<EncodingMatch> `](</hack/reference/class/EncodingDetector/detectAll/>)\
  Returns an array of EncodingMatch objects containing all guesses
  for the encoding of the byte array

+ [` ->setDeclaredEncoding(string $encoding): void `](</hack/reference/class/EncodingDetector/setDeclaredEncoding/>)\
  If the user provided an encoding in metadata
  (like an HTTP or XML declaration),
  this can be used as an additional hint to the detector

+ [` ->setText(string $text): void `](</hack/reference/class/EncodingDetector/setText/>)\
  Sets the input byte array whose encoding is to be guessed

<!-- HHAPIDOC -->
