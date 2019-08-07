``` yamlmeta
{
    "name": "take",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Returns a ` Map ` containing the first `` n `` key/values of the current ``` Map ```




``` Hack
public function take(
  int $n,
): Map<Tk, Tv>;
```




The returned ` Map ` will always be a proper subset of the current `` Map ``.




` n ` is 1-based. So the first element is 1, the second 2, etc.




## Parameters




+ ` int $n ` - The last element that will be included in the `` Map ``.




## Returns




* ` Map<Tk, Tv> ` - A `` Map `` that is a proper subset of this ``` Map ``` up to ```` n ```` elements.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/take/001-basic-usage.php @@
<!-- HHAPIDOC -->
