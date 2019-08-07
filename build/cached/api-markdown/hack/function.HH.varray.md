``` yamlmeta
{
    "name": "HH\\varray",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/array/ext_array.php",
        "api-sources/hhvm/hphp/hack/hhi/container_functions.hhi"
    ]
}
```




``` Hack
namespace HH;

function varray<\Tv>(
  Traversable<\Tv> $arr,
): varray<\Tv>;
```




## Parameters




+ ` Traversable<\Tv> $arr `




## Returns




* ` varray<\Tv> `
<!-- HHAPIDOC -->
