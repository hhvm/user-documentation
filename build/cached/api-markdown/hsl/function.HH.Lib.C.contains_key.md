``` yamlmeta
{
    "name": "HH\\Lib\\C\\contains_key",
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




Returns true if the given KeyedContainer contains the key




``` Hack
namespace HH\Lib\C;

function contains_key<\Tk as arraykey, \Tv>(
  KeyedContainer<\Tk, \Tv> $container,
  \Tk $key,
): bool;
```




Time complexity: O(1)
Space complexity: O(1)




## Parameters




+ ` KeyedContainer<\Tk, \Tv> $container `
+ ` \Tk $key `




## Returns




* ` bool `
<!-- HHAPIDOC -->
