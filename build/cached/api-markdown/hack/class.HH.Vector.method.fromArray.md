``` yamlmeta
{
    "name": "fromArray",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




**Deprecated:** Use ` new Vector($arr) ` instead.




Returns a ` Vector ` containing the values from the specified `` array ``




``` Hack
public static function fromArray(
  darray<arraykey, Tv> $arr,
): Vector<Tv>;
```




This function is deprecated. Use ` new Vector($arr) ` instead.




## Parameters




+ ` darray<arraykey, Tv> $arr ` - The `` array `` to convert to a ``` Vector ```.




## Returns




* ` Vector<Tv> ` - A `` Vector `` with the values from the provided ``` array ```.
<!-- HHAPIDOC -->
