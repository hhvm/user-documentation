``` yamlmeta
{
    "name": "HH\\Lib\\C\\first_async",
    "sources": [
        "api-sources/hsl/src/c/async.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    },
    "fbonly messages": [
        "This function is available as `C\\gen_first()` in Facebook's www repository."
    ]
}
```




Returns the first element of the result of the given Awaitable, or null if
the Traversable is empty




``` Hack
namespace HH\Lib\C;

function first_async<\T>(
  \  Awaitable<Traversable<\T>> $awaitable,
): Awaitable<?\T>;
```




For non-Awaitable Traversables, see ` C\first `.




Time complexity: O(1)
Space complexity: O(1)




## Parameters




+ ` \ Awaitable<Traversable<\T>> $awaitable `




## Returns




* ` Awaitable<?\T> `
<!-- HHAPIDOC -->
