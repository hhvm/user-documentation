``` yamlmeta
{
    "name": "HH\\Lib\\Vec\\diff_by",
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




Returns a new vec containing only the elements of the first Traversable
that do not appear in the second one, where an element's identity is
determined by the scalar function




``` Hack
namespace HH\Lib\Vec;

function diff_by<\Tv, \Ts as arraykey>(
  \  Traversable<\Tv> $first,
  \  Traversable<\Tv> $second,
  \callable $scalar_func,
): vec<\Tv>;
```




For vecs that contain arraykey elements, see ` Vec\diff() `.




Time complexity: O((n + m) * s), where n is the size of ` $first `, m is the
size of `` $second ``, and s is the complexity of ``` $scalar_func ```
Space complexity: O(n + m), where n is the size of ```` $first ```` and m is the size
of ````` $second ````` -- note that this is bigger than O(n)




## Parameters




+ ` \ Traversable<\Tv> $first `
+ ` \ Traversable<\Tv> $second `
+ ` \callable $scalar_func `




## Returns




* ` vec<\Tv> `
<!-- HHAPIDOC -->
