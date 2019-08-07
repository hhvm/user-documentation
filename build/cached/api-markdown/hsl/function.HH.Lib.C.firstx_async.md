``` yamlmeta
{
    "name": "HH\\Lib\\C\\firstx_async",
    "sources": [
        "api-sources/hsl/src/c/async.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    },
    "fbonly messages": [
        "This function is available as `C\\gen_firstx()` in Facebook's www repository."
    ]
}
```




Returns the first element of the result of the given Awaitable, or throws if
the Traversable is empty




``` Hack
namespace HH\Lib\C;

function firstx_async<\T>(
  \  Awaitable<Traversable<\T>> $awaitable,
): Awaitable<\T>;
```




For non-Awaitable Traversables, see ` C\firstx `.




Time complexity: O(1)
Space complexity: O(1)




## Parameters




+ ` \ Awaitable<Traversable<\T>> $awaitable `




## Returns




* ` Awaitable<\T> `
<!-- HHAPIDOC -->
