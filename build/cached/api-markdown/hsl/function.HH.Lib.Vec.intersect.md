``` yamlmeta
{
    "name": "HH\\Lib\\Vec\\intersect",
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




Returns a new vec containing only the elements of the first Traversable that
appear in all the other ones




``` Hack
namespace HH\Lib\Vec;

function intersect<\Tv as arraykey>(
  \  Traversable<\Tv> $first,
  \  Traversable<\Tv> $second,
  \  Container<\Tv> ...$rest,
): vec<\Tv>;
```




Duplicate values are preserved.




Time complexity: O(n + m), where n is size of ` $first ` and m is the combined
size of `` $second `` plus all the ``` ...$rest ```
Space complexity: O(n), where n is size of ```` $first ````




## Parameters




+ ` \ Traversable<\Tv> $first `
+ ` \ Traversable<\Tv> $second `
+ ` \ Container<\Tv> ...$rest `




## Returns




* ` vec<\Tv> `
<!-- HHAPIDOC -->
