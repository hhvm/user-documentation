``` yamlmeta
{
    "name": "toImmMap",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-pair.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Pair.hhi"
    ],
    "class": "HH\\Pair"
}
```




Returns an immutable, integer-keyed map (` ImmMap `) based on the elements of
the current `` Pair ``




``` Hack
public function toImmMap(): ImmMap<int, mixed>;
```




The keys are 0 and 1.




## Returns




+ ` ImmMap<int, mixed> ` - an `` ImmMap `` with the values of the current ``` Pair ```.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Pair/toImmMap/001-basic-usage.php @@
<!-- HHAPIDOC -->
