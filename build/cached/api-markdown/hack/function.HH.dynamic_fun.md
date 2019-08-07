``` yamlmeta
{
    "name": "HH\\dynamic_fun",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/hh/ext_hh.php",
        "api-sources/hhvm/hphp/hack/hhi/dyn_func_pointers.hhi"
    ]
}
```




Construct a function pointer for the function with $name




``` Hack
namespace HH;

function dynamic_fun(
  string $func_name,
): \dynamic;
```




The function should
be marked __DynamicallyCallable.




## Parameters




+ ` string $func_name `




## Returns




* ` \dynamic `
<!-- HHAPIDOC -->
