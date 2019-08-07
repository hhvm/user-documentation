``` yamlmeta
{
    "name": "HH\\Lib\\Math\\abs",
    "sources": [
        "api-sources/hsl/src/math/compute.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns the absolute value of ` $number ` (`` $number `` if ``` $number ``` > 0,
```` -$number ```` if ````` $number ````` < 0)




``` Hack
namespace HH\Lib\Math;

function abs<\T as num>(
  \T $number,
): \T;
```




NB: for the smallest representable int, PHP_INT_MIN, the result is
"implementation-defined" because the corresponding positive number overflows
int. You will probably find that ` Math\abs(PHP_INT_MIN) === PHP_INT_MIN `,
meaning the function can return a negative result in that case. To ensure
an int is non-negative for hashing use `` $v & PHP_INT_MAX `` instead.




## Parameters




+ ` \T $number `




## Returns




* ` \T `
<!-- HHAPIDOC -->
