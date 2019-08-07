``` yamlmeta
{
    "name": "zip",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstMap"
}
```




Returns a ` ConstMap ` where each value is a `` Pair `` that combines the value
of the current ``` ConstMap ``` and the provided ```` Traversable ````




``` Hack
public function zip<Tu>(
  Traversable<Tu> $traversable,
):     ConstMap<Tk, Pair<Tv, Tu>>;
```




If the number of values of the current ` ConstMap ` are not equal to the
number of elements in the `` Traversable ``, then only the combined elements
up to and including the final element of the one with the least number of
elements is included.




The keys associated with the current ` ConstMap ` remain unchanged in the
returned `` ConstMap ``.




## Parameters




+ ` Traversable<Tu> $traversable ` - The `` Traversable `` to use to combine with the
  elements of the current ``` ConstMap ```.




## Returns




* ` ConstMap<Tk, Pair<Tv, Tu>> ` - The `` ConstMap `` that combines the values of the current
  ``` ConstMap ``` with the provided ```` Traversable ````.
<!-- HHAPIDOC -->
