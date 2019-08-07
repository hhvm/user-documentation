``` yamlmeta
{
    "name": "HH\\dynamic_class_meth",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/hh/ext_hh.php",
        "api-sources/hhvm/hphp/hack/hhi/dyn_func_pointers.hhi"
    ]
}
```




Construct a cls_meth pointer for the method $cls::$meth




``` Hack
namespace HH;

function dynamic_class_meth(
  string $cls_name,
  string $meth_name,
): \dynamic;
```




The method should be
a static method marked __DynamicallyCallable.




## Parameters




+ ` string $cls_name `
+ ` string $meth_name `




## Returns




* ` \dynamic `
<!-- HHAPIDOC -->
