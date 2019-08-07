``` yamlmeta
{
    "name": "toArray",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Returns an ` array ` containing the key/value pairs from the current `` Map ``




``` Hack
public function toArray(): HH\array<Tk, Tv>;
```




## Returns




+ ` HH\array<Tk, Tv> ` - an `` array `` containing the key and value pairs from the current
  ``` Map ```.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/toArray/001-basic-usage.php @@
<!-- HHAPIDOC -->
