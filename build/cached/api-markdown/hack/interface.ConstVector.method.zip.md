``` yamlmeta
{
    "name": "zip",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstVector"
}
```




Returns a ` ConstVector ` where each element is a `` Pair `` that combines the
element of the current ``` ConstVector ``` and the provided ```` Traversable ````




``` Hack
public function zip<Tu>(
  Traversable<Tu> $traversable,
):     ConstVector<Pair<Tv, Tu>>;
```




If the number of elements of the ` ConstVector ` are not equal to the
number of elements in the `` Traversable ``, then only the combined elements
up to and including the final element of the one with the least number of
elements is included.




## Parameters




+ ` Traversable<Tu> $traversable ` - The `` Traversable `` to use to combine with the
  elements of this ``` ConstVector ```.




## Returns




* ` ConstVector<Pair<Tv, Tu>> ` - The `` ConstVector `` that combines the values of the current
  ``` ConstVector ``` with the provided ```` Traversable ````.
<!-- HHAPIDOC -->
