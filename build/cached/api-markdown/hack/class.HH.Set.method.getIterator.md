``` yamlmeta
{
    "name": "getIterator",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Returns an iterator that points to beginning of the current ` Set `




``` Hack
public function getIterator(): HH\Rx\KeyedIterator<arraykey, Tv>;
```




## Returns




+ ` HH\Rx\KeyedIterator<arraykey, Tv> ` - A `` KeyedIterator `` that allows you to traverse the current ``` Set ```.




## Examples




This example shows how to get an iterator from a ` Set ` and how to consume it:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/getIterator/001-basic-usage.php @@
<!-- HHAPIDOC -->
