``` yamlmeta
{
    "name": "toImmMap",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Returns a deep, immutable copy (` ImmMap `) of the current `` Map ``




``` Hack
public function toImmMap(): ImmMap<Tk, Tv>;
```




## Returns




+ ` ImmMap<Tk, Tv> ` - an `` ImmMap `` that is a copy of this ``` Map ```.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/toImmMap/001-basic-usage.php @@
<!-- HHAPIDOC -->
