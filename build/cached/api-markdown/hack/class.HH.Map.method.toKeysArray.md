``` yamlmeta
{
    "name": "toKeysArray",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Returns an ` array ` whose values are the keys of the current `` Map ``




``` Hack
public function toKeysArray(): HH\varray<Tk>;
```




## Returns




+ ` HH\varray<Tk> ` - an integer-indexed `` array `` containing the keys from the current
  ``` Map ```.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/toKeysArray/001-basic-usage.php @@
<!-- HHAPIDOC -->
