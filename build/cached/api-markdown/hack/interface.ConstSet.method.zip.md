``` yamlmeta
{
    "name": "zip",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstSet"
}
```




Returns a ` ConstSet ` where each value is a `` Pair `` that combines the value
of the current ``` ConstSet ``` and the provided ```` Traversable ````




``` Hack
public function zip<Tu>(
  Traversable<Tu> $traversable,
): ConstSet<Pair<Tv, Tu>>;
```




If the number of values of the current ` ConstMap ` are not equal to the
number of elements in the `` Traversable ``, then only the combined elements
up to and including the final element of the one with the least number of
elements is included.




Note that some implementations of sets only support certain types of keys
(e.g., only ` int ` or `` string `` values allowed). In that case, this method
could thrown an exception since a ``` Pair ``` wouldn't be supported/




## Parameters




+ ` Traversable<Tu> $traversable ` - The `` Traversable `` to use to combine with the
  elements of the current ``` ConstSet ```.




## Returns




* ` ConstSet<Pair<Tv, Tu>> ` - The `` ConstSet `` that combines the values of the current
  ``` ConstSet ``` with the provided ```` Traversable ````.
<!-- HHAPIDOC -->
