``` yamlmeta
{
    "name": "HH\\serialize_memoize_param",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/hh/ext_hh.php"
    ]
}
```




Takes an argument to a function marked with <<__Memoize>> and serializes it
to a string usable as a unique cache key




``` Hack
namespace HH;

function serialize_memoize_param(
  \mixed $param,
): \arraykey;
```




This works with all builtin types
and with objects that implement the HH\\IMemoizeParam interface




## Parameters




+ ` \mixed $param `




## Returns




* ` \arraykey `
<!-- HHAPIDOC -->
