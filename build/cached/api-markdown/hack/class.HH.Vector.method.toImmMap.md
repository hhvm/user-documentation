``` yamlmeta
{
    "name": "toImmMap",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Returns an immutable, integer-keyed map (` ImmMap `) based on the values of
the current `` Vector ``




``` Hack
public function toImmMap(): ImmMap<int, Tv>;
```




## Returns




+ ` ImmMap<int, Tv> ` - An `` ImmMap `` that has the integer keys and associated values
  of the current ``` Vector ```.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/toImmMap/001-basic-usage.php @@
<!-- HHAPIDOC -->
