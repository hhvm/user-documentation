``` yamlmeta
{
    "name": "removeKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/shapes/ext_shapes.php",
        "api-sources/hhvm/hphp/hack/hhi/Shapes.hhi"
    ],
    "class": "HH\\Shapes"
}
```




Returns a $shape with $index field removed




``` Hack
public static function removeKey<T as shape(...)>(
  HH\darray $shape,
  arraykey $index,
): void;
```




Currently allowed only for
local variables.




## Parameters




+ ` HH\darray $shape `
+ ` arraykey $index `




## Returns




* ` void `




## Examples




This example shows that ` removeKey ` directly removes a key from a `` Shape ``:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Shapes/removeKey/001-basic-usage.php @@
<!-- HHAPIDOC -->
