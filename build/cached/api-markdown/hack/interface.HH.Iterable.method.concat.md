``` yamlmeta
{
    "name": "concat",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/IteratorAggregate.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\Iterable"
}
```




Returns an ` Iterable ` that is the concatenation of the values of the
current `` Iterable `` and the values of the provided ``` Traversable ```




``` Hack
public function concat<Tu super Tv>(
      Traversable<Tu> $traversable,
): Iterable<Tu>;
```




The values of the provided ` Traversable ` is concatenated to the end of the
current `` Iterable `` to produce the returned ``` Iterable ```.




## Parameters




+ ` Traversable<Tu> $traversable ` - The `` Traversable `` to concatenate to the current
  ``` Iterable ```.




## Returns




* ` Iterable<Tu> ` - The concatenated `` Iterable ``.
<!-- HHAPIDOC -->
