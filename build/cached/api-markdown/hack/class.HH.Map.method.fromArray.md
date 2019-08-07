``` yamlmeta
{
    "name": "fromArray",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




**Deprecated:** Use ` new Map($arr) ` instead.




Returns a ` Map ` containing the key/value pairs from the specified `` array ``




``` Hack
public static function fromArray(
  darray<Tk, Tv> $arr,
): Map<Tk, Tv>;
```




This function is deprecated. Use ` new `Map`` ($arr) `` instead.




## Parameters




+ ` darray<Tk, Tv> $arr ` - The `` array `` to convert to a ``` Map ```.




## Returns




* ` Map<Tk, Tv> ` - A `` Map `` with the key/value pairs from the provided ``` array ```.
<!-- HHAPIDOC -->
