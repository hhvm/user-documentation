``` yamlmeta
{
    "name": "skip",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Returns a ` Map ` containing the values after the `` n ``-th element of the
current ``` Map ```




``` Hack
public function skip(
  int $n,
): Map<Tk, Tv>;
```




The returned ` Map ` will always be a proper subset of the current `` Map ``.




` n ` is 1-based. So the first element is 1, the second 2, etc.




## Parameters




+ ` int $n ` - The last element to be skipped; the `` $n+1 `` element will be the
  first one in the returned ``` Map ```.




## Returns




* ` Map<Tk, Tv> ` - A `` Map `` that is a proper subset of the current ``` Map ``` containing
  values after the specified ```` n ````-th element.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/skip/001-basic-usage.php @@
<!-- HHAPIDOC -->
