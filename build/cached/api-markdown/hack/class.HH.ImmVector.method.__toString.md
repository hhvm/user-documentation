``` yamlmeta
{
    "name": "__toString",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmVector.hhi"
    ],
    "class": "HH\\ImmVector"
}
```




Returns the ` string ` version of the current `` ImmVector ``, which is
``` "ImmVector" ```




``` Hack
public function __toString(): string;
```




## Returns




+ ` string ` - The `` string `` ``` "ImmVector" ```.




## Examples




The string version of a ` Vector ` is always `` "Vector" ``:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.ImmVector/__toString/001-basic-usage.php @@
<!-- HHAPIDOC -->
