``` yamlmeta
{
    "name": "immutable",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Returns a deep, immutable copy (` ImmMap `) of this `` Map ``




``` Hack
public function immutable(): HH\ImmMap<Tk, Tv>;
```




This method is interchangeable with ` toImmMap() `.




## Returns




+ ` HH\ImmMap<Tk, Tv> ` - an `` ImmMap `` that is a deep copy of this ``` Map ```.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/immutable/001-basic-usage.php @@
<!-- HHAPIDOC -->
