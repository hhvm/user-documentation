``` yamlmeta
{
    "name": "HH\\class_meth_get_method",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/std/ext_std_classobj.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_class.hhi"
    ]
}
```




Get method name from class_meth




``` Hack
namespace HH;

function class_meth_get_method(
  mixed $class_meth,
): string;
```




## Parameters




+ ` mixed $class_meth `




## Returns




* ` method ` - name
<!-- HHAPIDOC -->
