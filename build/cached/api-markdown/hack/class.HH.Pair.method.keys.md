``` yamlmeta
{
    "name": "keys",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-pair.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Pair.hhi"
    ],
    "class": "HH\\Pair"
}
```




Returns an ` ImmVector ` with the values being the keys of the current
`` Pair ``




``` Hack
public function keys(): ImmVector<int>;
```




This method will return an ` ImmVector ` with keys 0 and 1, and values 0 and
1, since the keys of a `` Pair `` are 0 and 1.




## Returns




+ ` ImmVector<int> ` - an `` ImmVector `` containing the integer keys of the current
  ``` Pair ``` as values.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Pair/keys/001-basic-usage.php @@
<!-- HHAPIDOC -->
