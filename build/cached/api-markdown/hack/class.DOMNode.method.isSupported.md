``` yamlmeta
{
    "name": "isSupported",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/domdocument/ext_domdocument.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_dom.hhi"
    ],
    "class": "DOMNode"
}
```




Checks if the asked feature is supported for the specified version




``` Hack
public function isSupported(
  string $feature,
  string $version,
): bool;
```




## Parameters




+ ` string $feature ` - The feature to test. See the example of
  DOMImplementation::hasFeature() for a list of features.
+ ` string $version ` - The version number of the feature to test.




## Returns




* ` bool ` - - Returns TRUE on success or FALSE on failure.
<!-- HHAPIDOC -->
