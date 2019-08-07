``` yamlmeta
{
    "name": "get",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstIndexAccess"
}
```




Returns the value at the specified key in the current collection




``` Hack
public function get(
  Tk $k,
): ?Tv;
```




If the key is not present, ` null ` is returned. If you would rather have an
exception thrown when a key is not present, then use `` at() ``.




## Parameters




+ ` Tk $k ` - the key from which to retrieve the value.




## Returns




* ` ?Tv ` - The value at the specified key; or `` null `` if the key does not
  exist.
<!-- HHAPIDOC -->
