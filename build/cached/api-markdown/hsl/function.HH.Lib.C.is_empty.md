``` yamlmeta
{
    "name": "HH\\Lib\\C\\is_empty",
    "sources": [
        "api-sources/hsl/src/c/introspect.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns whether the given Container is empty




``` Hack
namespace HH\Lib\C;

function is_empty<\T>(
  Container<\T> $container,
): bool;
```




Time complexity: O(1)
Space complexity: O(1)




## Parameters




+ ` Container<\T> $container `




## Returns




* ` bool `
<!-- HHAPIDOC -->
