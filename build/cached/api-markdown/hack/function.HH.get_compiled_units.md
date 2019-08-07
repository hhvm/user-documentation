``` yamlmeta
{
    "name": "HH\\get_compiled_units",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/hh/ext_hh.php"
    ]
}
```




Get the number of units that were loaded for this request, filtering for
units which ($kind = 0) were compiled in this request, ($kind = 1) were
compiled or loaded from the bytecode cache in this request, or ($kind = 2)
were compiled, loaded from disk cache, or caused the request to stall waiting
for loading to complete in another request




``` Hack
namespace HH;

function get_compiled_units(
  int $kind = 0,
): keyset;
```




If $kind < 0, only return units
which weren't shown to be identical at the bytecode level.




## Parameters




+ ` int $kind = 0 `




## Returns




* ` keyset `
<!-- HHAPIDOC -->
