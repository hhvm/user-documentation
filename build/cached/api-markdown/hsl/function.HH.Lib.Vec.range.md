``` yamlmeta
{
    "name": "HH\\Lib\\Vec\\range",
    "sources": [
        "api-sources/hsl/src/vec/order.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns a new vec containing the range of numbers from ` $start ` to `` $end ``
inclusive, with the step between elements being ``` $step ``` if provided, or 1 by
default




``` Hack
namespace HH\Lib\Vec;

function range<\Tv as num>(
  \Tv $start,
  \Tv $end,
  ?\Tv $step = NULL,
): vec<\Tv>;
```




If ` $start > $end `, it returns a descending range instead of
an empty one.




Time complexity: O(n), where ` n ` is the size of the resulting vec
Space complexity: O(n), where `` n `` is the size of the resulting vec




## Parameters




+ ` \Tv $start `
+ ` \Tv $end `
+ ` ?\Tv $step = NULL `




## Returns




* ` vec<\Tv> `
<!-- HHAPIDOC -->
