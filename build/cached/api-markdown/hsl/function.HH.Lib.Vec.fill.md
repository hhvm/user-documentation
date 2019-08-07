``` yamlmeta
{
    "name": "HH\\Lib\\Vec\\fill",
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




Returns a new vec of size ` $size ` where all the values are `` $value ``




``` Hack
namespace HH\Lib\Vec;

function fill<\Tv>(
  int $size,
  \Tv $value,
): vec<\Tv>;
```




Time complexity: O(n)
Space complexity: O(n)




## Parameters




+ ` int $size `
+ ` \Tv $value `




## Returns




* ` vec<\Tv> `
<!-- HHAPIDOC -->
