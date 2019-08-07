``` yamlmeta
{
    "name": "HH\\clear_static_memoization",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/hh/ext_hh.php",
        "api-sources/hhvm/hphp/hack/hhi/functions.hhi"
    ]
}
```




Clear memoization data

+ if $cls is non-null, clear memoziation cache for $cls::$func,
  or for all static memoized methods if $func is null
+ if $cls is null, clear memoization cache for $func




``` Hack
namespace HH;

function clear_static_memoization(
  ?string $cls,
  ?string $func = NULL,
): bool;
```




## Parameters




* ` ?string $cls `
* ` ?string $func = NULL `




## Returns




- ` bool `
<!-- HHAPIDOC -->
