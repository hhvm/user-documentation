``` yamlmeta
{
    "name": "concat",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/KeyedIterable.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\KeyedIterable"
}
```




Returns an ` Iterable ` that is the concatenation of the values of the
current `` KeyedIterable `` and the values of the provided ``` Traversable ```




``` Hack
public function concat<Tu super Tv>(
      Traversable<Tu> $traversable,
): Iterable<Tu>;
```




The values of the provided ` Traversable ` is concatenated to the end of the
current `` KeyedIterable `` to produce the returned ``` Iterable ```.




## Parameters




+ ` Traversable<Tu> $traversable ` - The `` Traversable `` to concatenate to the current
  ``` KeyedIterable ```.




## Returns




* ` Iterable<Tu> ` - The concatenated `` Iterable ``.
<!-- HHAPIDOC -->
