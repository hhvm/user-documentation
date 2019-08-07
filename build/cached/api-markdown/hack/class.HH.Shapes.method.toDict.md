``` yamlmeta
{
    "name": "toDict",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/shapes/ext_shapes.php",
        "api-sources/hhvm/hphp/hack/hhi/Shapes.hhi"
    ],
    "class": "HH\\Shapes"
}
```




``` Hack
public static function toDict<T as shape(...)>(
  HH\darray $shape,
): dict<arraykey, mixed>;
```




## Parameters




+ ` HH\darray $shape `




## Returns




* ` dict<arraykey, mixed> `
<!-- HHAPIDOC -->
