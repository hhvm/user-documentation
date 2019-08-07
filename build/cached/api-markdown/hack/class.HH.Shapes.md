``` yamlmeta
{
    "name": "HH\\Shapes",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/shapes/ext_shapes.php",
        "api-sources/hhvm/hphp/hack/hhi/Shapes.hhi"
    ],
    "class": "HH\\Shapes"
}
```




## Interface Synopsis




``` Hack
namespace HH;

abstract final class Shapes {...}
```




### Public Methods




+ [` ::at<\T as shape(...)>(darray $shape, \arraykey $index) `](</hack/reference/class/HH.Shapes/at/>)\
  Returns the value of the field $index of $shape,
  throws if the field is missing
+ [` ::idx<\T as shape(...)>(darray $shape, \arraykey $index, \mixed $default = NULL): \mixed `](</hack/reference/class/HH.Shapes/idx/>)\
  Shapes::idx is a helper function for accessing shape field value, or getting
  a default if it's not set - similar to idx(), but for shapes
+ [` ::keyExists<\T as shape(...)>(darray $shape, \arraykey $index): bool `](</hack/reference/class/HH.Shapes/keyExists/>)\
  Check if a field in shape exists
+ [` ::removeKey<\T as shape(...)>(darray $shape, \arraykey $index): \void `](</hack/reference/class/HH.Shapes/removeKey/>)\
  Returns a $shape with $index field removed
+ [` ::toArray<\T as shape(...)>(darray $shape): darray<\arraykey, \mixed> `](</hack/reference/class/HH.Shapes/toArray/>)
+ [` ::toDict<\T as shape(...)>(darray $shape): dict<\arraykey, \mixed> `](</hack/reference/class/HH.Shapes/toDict/>)
<!-- HHAPIDOC -->
