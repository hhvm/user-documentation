``` yamlmeta
{
    "name": "HH\\darray",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/array/ext_array.php",
        "api-sources/hhvm/hphp/hack/hhi/container_functions.hhi"
    ]
}
```




``` Hack
namespace HH;

function darray<\Tk as arraykey, \Tv>(
  KeyedTraversable<\Tk, \Tv> $arr,
): darray<\Tk, \Tv>;
```




## Parameters




+ ` KeyedTraversable<\Tk, \Tv> $arr `




## Returns




* ` darray<\Tk, \Tv> `
<!-- HHAPIDOC -->
