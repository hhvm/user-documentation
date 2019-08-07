``` yamlmeta
{
    "name": "HH\\Lib\\C\\count",
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




Returns the number of elements in the given Container




``` Hack
namespace HH\Lib\C;

function count<\T>(
  Container<\T> $container,
): int;
```




Time complexity: O(1)
Space complexity: O(1)




## Parameters




+ ` Container<\T> $container `




## Returns




* ` int `
<!-- HHAPIDOC -->
