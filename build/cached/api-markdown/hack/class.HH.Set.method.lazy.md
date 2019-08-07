``` yamlmeta
{
    "name": "lazy",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Returns a lazy, access elements only when needed view of the current
` Set `




``` Hack
public function lazy(): HH\Rx\KeyedIterable<arraykey, Tv>;
```




Normally, memory is allocated for all of the elements of the ` Set `. With
a lazy view, memory is allocated for an element only when needed or used
in a calculation like in `` map() `` or ``` filter() ```.




## Returns




+ ` HH\Rx\KeyedIterable<arraykey, Tv> ` - an `` KeyedIterable `` representing the lazy view into the current
  ``` Set ```, where the keys are the same as the values.




## Examples




This example shows you how to use ` lazy() ` on a rather large `` Set `` and the time for both a *strict* and *non-strict* version. Since we only need 5 of the elements in the end, the lazy view actually allows us to stop after we meet our required 5 without having to actually filter and allocate all 1000000 elements up front.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/lazy/001-basic-usage.php @@
<!-- HHAPIDOC -->
