``` yamlmeta
{
    "name": "HH\\invariant_callback_register",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/invariant.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/func_pointers.hhi"
    ]
}
```




Pass a function that will be called if any ` invariant ` fails




``` Hack
namespace HH;

function invariant_callback_register(
  \callable $callback,
): \void;
```




The callback
will be called with all the invariant parameters after the condition.




## Parameters




+ ` \callable $callback ` - The function that will be called if your invariant fails.




## Returns




* ` \void `
<!-- HHAPIDOC -->
