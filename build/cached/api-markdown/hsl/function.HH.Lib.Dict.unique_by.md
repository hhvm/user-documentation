``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\unique_by",
    "sources": [
        "api-sources/hsl/src/dict/select.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns a new dict in which each value appears exactly once, where the
value's uniqueness is determined by transforming it to a scalar via the
given function




``` Hack
namespace HH\Lib\Dict;

function unique_by<\Tk as arraykey, \Tv, \Ts as arraykey>(
  \  KeyedContainer<\Tk, \Tv> $container,
  \callable $scalar_func,
): dict<\Tk, \Tv>;
```




In case of duplicate scalar values, later keys will overwrite
the previous ones.




For arraykey values, see ` Dict\unique() `.




Time complexity: O(n * s), where s is the complexity of ` $scalar_func `
Space complexity: O(n)




## Parameters




+ ` \ KeyedContainer<\Tk, \Tv> $container `
+ ` \callable $scalar_func `




## Returns




* ` dict<\Tk, \Tv> `
<!-- HHAPIDOC -->
