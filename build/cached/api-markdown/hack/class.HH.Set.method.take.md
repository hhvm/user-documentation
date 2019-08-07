``` yamlmeta
{
    "name": "take",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Returns a ` Set ` containing the first `` n `` values of the current ``` Set ```




``` Hack
public function take(
  int $n,
): Set<Tv>;
```




The returned ` Set ` will always be a proper subset of the current `` Set ``.




` n ` is 1-based. So the first element is 1, the second 2, etc.




## Parameters




+ ` int $n ` - The last element that will be included in the `` Set ``.




## Returns




* ` Set<Tv> ` - A `` Set `` that is a proper subset of the current ``` Set ``` up to ```` n ````
  elements.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/take/001-basic-usage.php @@
<!-- HHAPIDOC -->
