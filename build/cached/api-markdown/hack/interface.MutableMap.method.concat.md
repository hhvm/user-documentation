``` yamlmeta
{
    "name": "concat",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableMap"
}
```




Returns a ` MutableVector ` that is the concatenation of the values of the
current `` MutableMap `` and the values of the provided ``` Traversable ```




``` Hack
public function concat<Tu super Tv>(
  Traversable<Tu> $traversable,
):     MutableVector<Tu>;
```




The provided ` Traversable ` is concatenated to the end of the current
`` MutableMap `` to produce the returned ``` MutableVector ```.




## Parameters




+ ` Traversable<Tu> $traversable ` - The `` Traversable `` to concatenate to the current
  ``` MutableMap ```.




## Returns




* ` MutableVector<Tu> ` - The integer-indexed concatenated `` MutableVector ``.
<!-- HHAPIDOC -->
