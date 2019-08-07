``` yamlmeta
{
    "name": "keyExists",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/shapes/ext_shapes.php",
        "api-sources/hhvm/hphp/hack/hhi/Shapes.hhi"
    ],
    "class": "HH\\Shapes"
}
```




Check if a field in shape exists




``` Hack
public static function keyExists<T as shape(...)>(
  HH\darray $shape,
  arraykey $index,
): bool;
```




Similar to array_key_exists, but for shapes.




## Parameters




+ ` HH\darray $shape `
+ ` arraykey $index `




## Returns




* ` bool `




## Examples




This example shows that ` keyExists ` returns true if a key exists in the `` Shape `` (even if the corresponding value is ``` NULL ```):







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Shapes/keyExists/001-basic-usage.php @@
<!-- HHAPIDOC -->
