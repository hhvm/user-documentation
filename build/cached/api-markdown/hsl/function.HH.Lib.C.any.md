``` yamlmeta
{
    "name": "HH\\Lib\\C\\any",
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




Returns true if the given predicate returns true for any element of the
given Traversable




``` Hack
namespace HH\Lib\C;

function any<\T>(
  \  Traversable<\T> $traversable,
  ?\callable $predicate = NULL,
): bool;
```




If no predicate is provided, it defaults to casting the
element to bool.




If you're looking for ` C\none `, use `` !C\any ``.




Time complexity: O(n)
Space complexity: O(1)




## Parameters




+ ` \ Traversable<\T> $traversable `
+ ` ?\callable $predicate = NULL `




## Returns




* ` bool `
<!-- HHAPIDOC -->
