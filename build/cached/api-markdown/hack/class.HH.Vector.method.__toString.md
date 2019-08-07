``` yamlmeta
{
    "name": "__toString",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Returns the ` string ` version of the current `` Vector ``, which is ``` "Vector" ```




``` Hack
public function __toString(): string;
```




## Returns




+ ` string ` - The string `` "Vector" ``.




## Examples




The string version of an ` ImmVector ` is always `` "ImmVector" ``:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/__toString/001-basic-usage.php @@
<!-- HHAPIDOC -->
