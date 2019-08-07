``` yamlmeta
{
    "name": "HH\\clear_lsb_memoization",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/hh/ext_hh.php",
        "api-sources/hhvm/hphp/hack/hhi/functions.hhi"
    ]
}
```




Clear __MemoizeLSB data

+ if $func is non-null, clear cache for $cls::$func
+ if $func is null, clear all LSB memoization caches for $cls




``` Hack
namespace HH;

function clear_lsb_memoization(
  string $cls,
  ?string $func = NULL,
): bool;
```




Operates on a single class at a time. Clearing the cache for $cls::$func
does not clear the cache for $otherClass::$func, for any other class.




## Parameters




* ` string $cls `
* ` ?string $func = NULL `




## Returns




- ` bool `
<!-- HHAPIDOC -->
