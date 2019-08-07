``` yamlmeta
{
    "name": "HH\\meth_caller_get_class",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/std/ext_std_classobj.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_class.hhi"
    ]
}
```




Get class name from meth_caller




``` Hack
namespace HH;

function meth_caller_get_class(
  mixed $meth_caller,
): string;
```




## Parameters




+ ` mixed $meth_caller `




## Returns




* ` class ` - name
<!-- HHAPIDOC -->
