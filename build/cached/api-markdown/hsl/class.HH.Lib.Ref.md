``` yamlmeta
{
    "name": "HH\\Lib\\Ref",
    "sources": [
        "api-sources/hsl/src/Ref.php"
    ],
    "class": "HH\\Lib\\Ref",
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Wrapper class for getting object (byref) semantics for a value type




This is especially useful for mutating values outside of a lambda's scope.




In eralAsync, it's preferable to refactor to use return values or ` inout `
parameters instead of using this class - however, a `` Ref `` of a Hack array
is generally preferable to a Hack collection - e.g. prefer ``` Ref<vec<T>> ```
over ```` Vector<T> ````.




` C\reduce() ` and `` C\reduce_with_key() `` can also be used in some situations
to avoid this class.




## Interface Synopsis




``` Hack
namespace HH\Lib;

final class Ref {...}
```




### Public Methods




+ [` ->__construct(\T $value) `](<>)
<!-- HHAPIDOC -->
