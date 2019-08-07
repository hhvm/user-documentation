``` yamlmeta
{
    "name": "zip",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/KeyedIterable.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\KeyedIterable"
}
```




Returns a ` KeyedIterable ` where each element is a `` Pair `` that combines the
element of the current ``` KeyedIterable ``` and the provided ```` Traversable ````




``` Hack
public function zip<Tu>(
  Traversable<Tu> $traversable,
):     KeyedIterable<Tk, Pair<Tv, Tu>>;
```




If the number of elements of the ` KeyedIterable ` are not equal to the
number of elements in the `` Traversable ``, then only the combined elements
up to and including the final element of the one with the least number of
elements is included.




@param $traversable - The ` Traversable ` to use to combine with the
elements of the current `` KeyedIterable ``.




@return - The ` KeyedIterable ` that combines the values of the current
`` KeyedItearable `` with the provided ``` Traversable ```.




## Parameters




+ ` Traversable<Tu> $traversable `




## Returns




* ` KeyedIterable<Tk, Pair<Tv, Tu>> `
<!-- HHAPIDOC -->
