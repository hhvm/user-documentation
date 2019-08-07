``` yamlmeta
{
    "name": "HH\\Lib\\Vec\\diff",
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
do not appear in any of the other ones




``` Hack
namespace HH\Lib\Vec;

function diff<\Tv1 as arraykey, \Tv2 as arraykey>(
  \  Traversable<\Tv1> $first,
  \  Traversable<\Tv2> $second,
  \  Container<\Tv2> ...$rest,
): vec<\Tv1>;
```




For vecs that contain non-arraykey elements, see ` Vec\diff_by() `.




Time complexity: O(n + m), where n is size of ` $first ` and m is the combined
size of `` $second `` plus all the ``` ...$rest ```
Space complexity: O(n + m), where n is size of ```` $first ```` and m is the combined
size of ````` $second ````` plus all the `````` ...$rest `````` -- note that this is bigger than
O(n)




## Parameters




+ ` \ Traversable<\Tv1> $first `
+ ` \ Traversable<\Tv2> $second `
+ ` \ Container<\Tv2> ...$rest `




## Returns




* ` vec<\Tv1> `
<!-- HHAPIDOC -->
