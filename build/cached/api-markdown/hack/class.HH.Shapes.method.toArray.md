``` yamlmeta
{
    "name": "toArray",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/shapes/ext_shapes.php",
        "api-sources/hhvm/hphp/hack/hhi/Shapes.hhi"
    ],
    "class": "HH\\Shapes"
}
```




``` Hack
public static function toArray<T as shape(...)>(
  HH\darray $shape,
): HH\darray<arraykey, mixed>;
```




## Parameters




+ ` HH\darray $shape `




## Returns




* ` HH\darray<arraykey, mixed> `




## Examples




This example shows that ` toArray ` will return the underlying array of a `` Shape ``. The result will be loosely typed because a single ``` Shape ``` can contain arbitrary different types (e.g. ```` string ````, ````` int `````, `````` float ``````).







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Shapes/toArray/001-basic-usage.php @@
<!-- HHAPIDOC -->
