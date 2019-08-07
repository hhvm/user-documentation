``` yamlmeta
{
    "name": "HH\\Lib\\Vec\\flatten",
    "sources": [
        "api-sources/hsl/src/vec/transform.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns a new vec formed by joining the Traversable elements of the given
Traversable




``` Hack
namespace HH\Lib\Vec;

function flatten<\Tv>(
  \  Traversable<Container<\Tv>> $traversables,
): vec<\Tv>;
```




For a fixed number of Traversables, see ` Vec\concat() `.




Time complexity: O(n), where n is the combined size of all the
` $traversables `
Space complexity: O(n), where n is the combined size of all the
`` $traversables ``




## Parameters




+ ` \ Traversable<Container<\Tv>> $traversables `




## Returns




* ` vec<\Tv> `
<!-- HHAPIDOC -->
