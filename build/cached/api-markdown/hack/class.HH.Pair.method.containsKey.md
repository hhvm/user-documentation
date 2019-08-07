``` yamlmeta
{
    "name": "containsKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-pair.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Pair.hhi"
    ],
    "class": "HH\\Pair"
}
```




Checks whether a provided key exists in the current ` Pair `




``` Hack
public function containsKey<Tu super int>(
  Tu $key,
): bool;
```




This will only return ` true ` for provided keys of 0 and 1 since those are
the only two keys that can exist in a `` Pair ``.




## Parameters




+ ` Tu $key `




## Returns




* ` bool ` - `` true `` if the provided key exists in the ``` Pair ```; ```` false ````
  otherwise. This will only return ````` true ````` if the provided key is
  0 or 1.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Pair/containsKey/001-basic-usage.php @@
<!-- HHAPIDOC -->
