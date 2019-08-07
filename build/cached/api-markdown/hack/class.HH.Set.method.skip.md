``` yamlmeta
{
    "name": "skip",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Returns a ` Set ` containing the values after the `` n ``-th element of the
current ``` Set ```




``` Hack
public function skip(
  int $n,
): Set<Tv>;
```




The returned ` Set ` will always be a proper subset of the current `` Set ``.




` n ` is 1-based. So the first element is 1, the second 2, etc.




## Parameters




+ ` int $n ` - The last element to be skipped; the `` $n+1 `` element will be
  the first one in the returned ``` Set ```.




## Returns




* ` Set<Tv> ` - A `` Set `` that is a proper subset of the current ``` Set ``` containing
  values after the specified ```` n ````-th element.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/skip/001-basic-usage.php @@
<!-- HHAPIDOC -->
