``` yamlmeta
{
    "name": "HH\\Lib\\C\\contains",
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




Returns true if the given Traversable contains the value




``` Hack
namespace HH\Lib\C;

function contains<\T>(
  \  Traversable<\T> $traversable,
  \T $value,
): bool;
```




Strict equality is
used.




Time complexity: O(n)
Space complexity: O(1)




## Parameters




+ ` \ Traversable<\T> $traversable `
+ ` \T $value `




## Returns




* ` bool `
<!-- HHAPIDOC -->
