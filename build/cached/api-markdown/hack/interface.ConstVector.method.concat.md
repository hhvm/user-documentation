``` yamlmeta
{
    "name": "concat",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstVector"
}
```




Returns a ` ConstVector ` that is the concatenation of the values of the
current `` ConstVector `` and the values of the provided ``` Traversable ```




``` Hack
public function concat<Tu super Tv>(
  Traversable<Tu> $traversable,
):     ConstVector<Tu>;
```




The values of the provided ` Traversable ` is concatenated to the end of the
current `` ConstVector `` to produce the returned ``` ConstVector ```.




## Parameters




+ ` Traversable<Tu> $traversable ` - The `` Traversable `` to concatenate to the current
  ``` ConstVector ```.




## Returns




* ` ConstVector<Tu> ` - The concatenated `` ConstVector ``.
<!-- HHAPIDOC -->
