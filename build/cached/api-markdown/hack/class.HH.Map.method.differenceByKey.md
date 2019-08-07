``` yamlmeta
{
    "name": "differenceByKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Returns a new ` Map ` with the keys that are in the current `` Map ``, but not
in the provided ``` KeyedTraversable ```




``` Hack
public function differenceByKey(
  KeyedTraversable<Tk, Tv> $traversable,
):     Map<Tk, Tv>;
```




## Parameters




+ ` KeyedTraversable<Tk, Tv> $traversable ` - The `` KeyedTraversable `` on which to compare the keys.




## Returns




* ` Map<Tk, Tv> ` - A `` Map `` containing the keys (and associated values) of the
  current ``` Map ``` that are not in the ```` KeyedTraversable ````.




## Examples




This example shows how ` differenceByKey ` can be used to get a new `` Map `` with some keys excluded:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/differenceByKey/001-basic-usage.php @@
<!-- HHAPIDOC -->
