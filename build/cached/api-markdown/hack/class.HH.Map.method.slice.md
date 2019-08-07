``` yamlmeta
{
    "name": "slice",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Returns a subset of the current ` Map ` starting from a given key location
up to, but not including, the element at the provided length from the
starting key location




``` Hack
public function slice(
  int $start,
  int $len,
): Map<Tk, Tv>;
```




` $start ` is 0-based. `` $len `` is 1-based. So ``` slice(0, 2) ``` would return the
keys and values at key location 0 and 1.




The returned ` Map ` will always be a proper subset of the current `` Map ``.




## Parameters




+ ` int $start ` - The starting key location of the current `` Map `` for the
  returned ``` Map ```.
+ ` int $len ` - The length of the returned `` Map ``.




## Returns




* ` Map<Tk, Tv> ` - A `` Map `` that is a proper subset of the current ``` Map ``` starting at
  ```` $start ```` up to but not including the element ````` $start + $len `````.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/slice/001-basic-usage.php @@
<!-- HHAPIDOC -->
