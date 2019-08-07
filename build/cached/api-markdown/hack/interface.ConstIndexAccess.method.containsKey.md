``` yamlmeta
{
    "name": "containsKey",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstIndexAccess"
}
```




Determines if the specified key is in the current collection




``` Hack
public function containsKey(
  mixed $k,
): bool;
```




## Parameters




+ ` mixed $k `




## Returns




* ` bool ` - `` true `` if the specified key is present in the current collection;
  ``` false ``` otherwise.
<!-- HHAPIDOC -->
