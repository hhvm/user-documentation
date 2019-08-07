``` yamlmeta
{
    "name": "hphp_invoke",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection-internals-functions.php"
    ]
}
```




hphp_invoke() - Used by ReflectionFunction to invoke a function




``` Hack
function hphp_invoke(
  string $name,
  Traversable $params,
): mixed;
```




## Parameters




+ ` string $name ` - The name of the function.
+ ` Traversable $params ` - The parameters to pass to the function.




## Returns




* ` mixed ` - - The result of the invoked function.
<!-- HHAPIDOC -->
