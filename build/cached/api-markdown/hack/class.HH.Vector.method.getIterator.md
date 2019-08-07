``` yamlmeta
{
    "name": "getIterator",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Returns an iterator that points to beginning of the current ` Vector `




``` Hack
public function getIterator(): HH\Rx\KeyedIterator<int, Tv>;
```




## Returns




+ ` HH\Rx\KeyedIterator<int, Tv> ` - A `` KeyedIterator `` that allows you to traverse the current
  ``` Vector ```.




## Examples




This example shows how to get an iterator from a ` Vector ` and how to consume it:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/getIterator/001-basic-usage.php @@
<!-- HHAPIDOC -->
