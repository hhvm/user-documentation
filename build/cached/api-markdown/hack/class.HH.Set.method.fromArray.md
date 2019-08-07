``` yamlmeta
{
    "name": "fromArray",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




**Deprecated:** Use ` new Set($arr) ` instead.




Returns a ` Set ` containing the values from the specified `` array ``




``` Hack
public static function fromArray(
  darray<arraykey, Tv> $arr,
): Set<Tv>;
```




This function is deprecated. Use ` new Set ($arr) ` instead.




## Parameters




+ ` darray<arraykey, Tv> $arr ` - The `` array `` to convert to a ``` Set ```.




## Returns




* ` Set<Tv> ` - A `` Set `` with the values from the provided ``` array ```.
<!-- HHAPIDOC -->
