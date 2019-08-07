``` yamlmeta
{
    "name": "slice",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Returns a subset of the current ` Set ` starting from a given key up to, but
not including, the element at the provided length from the starting key




``` Hack
public function slice(
  int $start,
  int $len,
): Set<Tv>;
```




` $start ` is 0-based. `` $len `` is 1-based. So ``` slice(0, 2) ``` would return the
elements at key 0 and 1.




The returned ` Set ` will always be a proper subset of the current `` Set ``.




## Parameters




+ ` int $start ` - The starting value in the current `` Set `` for the returned
  ``` Set ```.
+ ` int $len ` - The length of the returned `` Set ``.




## Returns




* ` Set<Tv> ` - A `` Set `` that is a proper subset of the current ``` Set ``` starting at
  ```` $start ```` up to but not including the element ````` $start + $len `````.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/slice/001-basic-usage.php @@
<!-- HHAPIDOC -->
