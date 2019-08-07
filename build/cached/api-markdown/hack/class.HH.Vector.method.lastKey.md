``` yamlmeta
{
    "name": "lastKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Returns the last key in the current ` Vector `




``` Hack
public function lastKey(): ?int;
```




## Returns




+ ` ?int ` - The last key (an integer) in the current `` Vector ``, or ``` null ``` if
  the ```` Vector ```` is empty.




## Examples




This example shows how ` lastKey() ` can be used even when a `` Vector `` may be empty:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/lastKey/001-basic-usage.php @@
<!-- HHAPIDOC -->
