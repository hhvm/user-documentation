``` yamlmeta
{
    "name": "zip",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableVector"
}
```




Returns a ` MutableVector ` where each element is a `` Pair `` that combines the
element of the current ``` MutableVector ``` and the provided ```` Traversable ````




``` Hack
public function zip<Tu>(
  Traversable<Tu> $traversable,
):     MutableVector<Pair<Tv, Tu>>;
```




If the number of elements of the ` MutableVector ` are not equal to the
number of elements in the `` Traversable ``, then only the combined elements
up to and including the final element of the one with the least number of
elements is included.




## Parameters




+ ` Traversable<Tu> $traversable ` - The `` Traversable `` to use to combine with the
  elements of this ``` MutableVector ```.




## Returns




* ` MutableVector<Pair<Tv, Tu>> ` - The `` MutableVector `` that combines the values of the current
  ``` MutableVector ``` with the provided ```` Traversable ````.
<!-- HHAPIDOC -->
