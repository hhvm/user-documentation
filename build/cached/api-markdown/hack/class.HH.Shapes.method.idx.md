``` yamlmeta
{
    "name": "idx",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/shapes/ext_shapes.php",
        "api-sources/hhvm/hphp/hack/hhi/Shapes.hhi"
    ],
    "class": "HH\\Shapes"
}
```




Shapes::idx is a helper function for accessing shape field value, or getting
a default if it's not set - similar to idx(), but for shapes




``` Hack
public static function idx<T as shape(...)>(
  HH\darray $shape,
  arraykey $index,
  mixed $default = NULL,
): mixed;
```




This behavior cannot be expressed with type hints, so it's hardcoded in the
typechecker. Depending on arity, it will be one of the




idx(S $shape, arraykey $index) : ?Tv,
idx(S $shape, arraykey $index, Tv $default) : Tv,




where $index must be statically known (literal or class constant), and S is
a shape containing such key:




type S = shape(
...
$index => Tv,
...
)




## Parameters




+ ` HH\darray $shape `
+ ` arraykey $index `
+ ` mixed $default = NULL `




## Returns




* ` mixed `




## Examples




This example shows how to use ` Shapes::idx ` for keys that may or may not exist in a `` Shape ``:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Shapes/idx/001-basic-usage.php @@




This example shows that ` Shapes::idx ` will only return the default value if the key doesn't exist in the `` Shape ``. If the key exists but is ``` NULL ``` then ```` NULL ```` will be returned.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Shapes/idx/002-nullable-values.php @@
<!-- HHAPIDOC -->
