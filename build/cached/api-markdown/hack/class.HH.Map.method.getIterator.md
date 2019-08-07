``` yamlmeta
{
    "name": "getIterator",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Returns an iterator that points to beginning of the current ` Map `




``` Hack
public function getIterator(): HH\Rx\KeyedIterator<Tk, Tv>;
```




## Returns




+ ` HH\Rx\KeyedIterator<Tk, Tv> ` - A `` KeyedIterator `` that allows you to traverse the current ``` Map ```.




## Examples




This example shows how to get a ` KeyedIterator ` from a `` Map `` and how to consume it:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/getIterator/001-basic-usage.php @@
<!-- HHAPIDOC -->
