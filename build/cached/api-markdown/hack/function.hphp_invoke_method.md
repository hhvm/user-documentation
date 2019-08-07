``` yamlmeta
{
    "name": "hphp_invoke_method",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection-internals-functions.php"
    ]
}
```




hphp_invoke_method() - Used by ReflectionMethod to invoke a method and by
ReflectionFunction to invoke a closure




``` Hack
function hphp_invoke_method(
  object $obj,
  string $cls,
  string $name,
  Traversable $params,
): mixed;
```




## Parameters




+ ` object $obj ` - An instance of the class or null for a
  static method.
+ ` string $cls ` - The name of the class.
+ ` string $name ` - The name of the method.
+ ` Traversable $params ` - The parameters to pass to the method.




## Returns




* ` mixed ` - - The result of the invoked method.
<!-- HHAPIDOC -->
