``` yamlmeta
{
    "name": "HH\\Lib\\Tuple\\from_async",
    "sources": [
        "api-sources/hsl/src/tuple/async.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    },
    "fbonly messages": [
        "This function is available as `Tuple\\gen()` in Facebook's www repository."
    ]
}
```




Create an awaitable tuple from variadic awaitables




``` Hack
namespace HH\Lib\Tuple;

function from_async(
  ?Awaitable<\mixed> ...$awaitables,
): Awaitable<\mixed>;
```




Given ` (Awaitable<T1>, Awaitable<T2>, ...) `, returns
`` Awaitable(T1, T2, ...) ``.




Nullable Awaitables are also supported:
` (?Awaitable<T1>, ?Awaitable<T2>, ...) ` is transformed to
`` Awaitable<(?T1, ?T2)> ``




This is particularly useful when combined with list assignment:




``` Hack
list($a, $b, $c) = await Tuple\from_async(
  foo_async(),
  bar_async(),
  baz_async(),
);
```




The function signature here is inaccurate as it can not be correctly
expressed in Hack; this function is special-cased in the typechecker.




## Parameters




+ ` ?Awaitable<\mixed> ...$awaitables `




## Returns




* ` Awaitable<\mixed> `
<!-- HHAPIDOC -->
