``` yamlmeta
{
    "name": "HH\\Lib\\Keyset\\intersect",
    "sources": [
        "api-sources/hsl/src/keyset/select.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns a new keyset containing only the elements of the first Traversable
that appear in all the other ones




``` Hack
namespace HH\Lib\Keyset;

function intersect<\Tv as arraykey>(
  \  Traversable<\Tv> $first,
  \  Traversable<\Tv> $second,
  \  Container<\Tv> ...$rest,
): keyset<\Tv>;
```




Time complexity: O(n + m), where n is size of ` $first ` and m is the combined
size of `` $second `` plus all the ``` ...$rest ```
Space complexity: O(n), where n is size of ```` $first ````




## Parameters




+ ` \ Traversable<\Tv> $first `
+ ` \ Traversable<\Tv> $second `
+ ` \ Container<\Tv> ...$rest `




## Returns




* ` keyset<\Tv> `
<!-- HHAPIDOC -->
