``` yamlmeta
{
    "name": "HH\\Lib\\Vec\\slice",
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




Returns a new vec containing the subsequence of the given Traversable
determined by the offset and length




``` Hack
namespace HH\Lib\Vec;

function slice<\Tv>(
  \  Container<\Tv> $container,
  int $offset,
  ?int $length = NULL,
): vec<\Tv>;
```




If no length is given or it exceeds the upper bound of the Traversable,
the vec will contain every element after the offset.




+ To take only the first ` $n ` elements, see `` Vec\take() ``.
+ To drop the first ` $n ` elements, see `` Vec\drop() ``.




Time complexity: O(n), where n is the size of the slice
Space complexity: O(n), where n is the size of the slice




## Parameters




* ` \ Container<\Tv> $container `
* ` int $offset `
* ` ?int $length = NULL `




## Returns




- ` vec<\Tv> `
<!-- HHAPIDOC -->
