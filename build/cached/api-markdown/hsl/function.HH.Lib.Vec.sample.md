``` yamlmeta
{
    "name": "HH\\Lib\\Vec\\sample",
    "sources": [
        "api-sources/hsl/src/vec/select.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns a new vec containing an unbiased random sample of up to
` $sample_size ` elements (fewer iff `` $sample_size `` is larger than the size of
``` $traversable ```)




``` Hack
namespace HH\Lib\Vec;

function sample<\Tv>(
  \  Traversable<\Tv> $traversable,
  int $sample_size,
): vec<\Tv>;
```




Time complexity: O(n), where n is the size of ` $traversable `
Space complexity: O(n), where n is the size of `` $traversable `` -- note that n
may be bigger than ``` $sample_size ```




## Parameters




+ ` \ Traversable<\Tv> $traversable `
+ ` int $sample_size `




## Returns




* ` vec<\Tv> `
<!-- HHAPIDOC -->
