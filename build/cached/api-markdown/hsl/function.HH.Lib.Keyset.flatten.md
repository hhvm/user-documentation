``` yamlmeta
{
    "name": "HH\\Lib\\Keyset\\flatten",
    "sources": [
        "api-sources/hsl/src/keyset/transform.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns a new keyset formed by joining the values
within the given Traversables into
a keyset




``` Hack
namespace HH\Lib\Keyset;

function flatten<\Tv as arraykey>(
  \  Traversable<Container<\Tv>> $traversables,
): keyset<\Tv>;
```




For a fixed number of Traversables, see ` Keyset\union() `.




Time complexity: O(n), where n is the combined size of all the
` $traversables `
Space complexity: O(n), where n is the combined size of all the
`` $traversables ``




## Parameters




+ ` \ Traversable<Container<\Tv>> $traversables `




## Returns




* ` keyset<\Tv> `
<!-- HHAPIDOC -->
