``` yamlmeta
{
    "name": "toMap",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Returns a deep copy of the current ` Map `




``` Hack
public function toMap(): this<Tk, Tv>;
```




## Returns




+ ` this<Tk, Tv> ` - a `` Map `` that is a deep copy of the current ``` Map ```.




## Examples




This example shows that ` toMap ` returns a deep copy of the `` Map `` ``` $m ```. Mutating the new ```` Map ```` ````` $m2 ````` doesn't affect the original `````` Map ``````.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/toMap/001-basic-usage.php @@
<!-- HHAPIDOC -->
