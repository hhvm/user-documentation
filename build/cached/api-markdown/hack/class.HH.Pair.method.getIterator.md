``` yamlmeta
{
    "name": "getIterator",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-pair.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Pair.hhi"
    ],
    "class": "HH\\Pair"
}
```




Returns an iterator that points to beginning of the current ` Pair `




``` Hack
public function getIterator(): HH\Rx\KeyedIterator<int, mixed>;
```




## Returns




+ ` HH\Rx\KeyedIterator<int, mixed> ` - A `` KeyedIterator `` that allows you to traverse the current ``` Pair ```.




## Examples




This example shows how to get an iterator from a ` Pair ` and how to consume it:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Pair/getIterator/001-basic-usage.php @@
<!-- HHAPIDOC -->
