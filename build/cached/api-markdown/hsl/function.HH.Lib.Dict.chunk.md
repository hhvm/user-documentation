``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\chunk",
    "sources": [
        "api-sources/hsl/src/dict/transform.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns a vec containing the original dict split into chunks of the given
size




``` Hack
namespace HH\Lib\Dict;

function chunk<\Tk as arraykey, \Tv>(
  \  KeyedTraversable<\Tk, \Tv> $traversable,
  int $size,
): vec<dict<\Tk, \Tv>>;
```




If the original dict doesn't divide evenly, the final chunk will be
smaller.




Time complexity: O(n)
Space complexity: O(n)




## Parameters




+ ` \ KeyedTraversable<\Tk, \Tv> $traversable `
+ ` int $size `




## Returns




* ` vec<dict<\Tk, \Tv>> `
<!-- HHAPIDOC -->
