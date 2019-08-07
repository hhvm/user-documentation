``` yamlmeta
{
    "name": "HH\\class_meth_get_class",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/std/ext_std_classobj.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_class.hhi"
    ]
}
```




Get class name from class_meth




``` Hack
namespace HH;

function class_meth_get_class(
  mixed $class_meth,
): string;
```




## Parameters




+ ` mixed $class_meth `




## Returns




* ` class ` - name
<!-- HHAPIDOC -->
