``` yamlmeta
{
    "name": "HH\\Lib\\Keyset\\keys",
    "sources": [
        "api-sources/hsl/src/keyset/select.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns a new keyset containing the keys of the given KeyedTraversable,
maintaining the iteration order




``` Hack
namespace HH\Lib\Keyset;

function keys<\Tk as arraykey, \Tv>(
  \  KeyedTraversable<\Tk, \Tv> $traversable,
): keyset<\Tk>;
```




## Parameters




+ ` \ KeyedTraversable<\Tk, \Tv> $traversable `




## Returns




* ` keyset<\Tk> `
<!-- HHAPIDOC -->
