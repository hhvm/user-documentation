``` yamlmeta
{
    "name": "take",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/IteratorAggregate.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\Iterable"
}
```




Returns an ` Iterable ` containing the first `` n `` values of the current
``` Iterable ```




``` Hack
public function take(
  int $n,
): Iterable<Tv>;
```




The returned ` Iterable ` will always be a proper subset of the current
`` Iterable ``.




` $n ` is 1-based. So the first element is 1, the second 2, etc.




## Parameters




+ ` int $n ` - The last element that will be included in the returned
  `` Iterable ``.




## Returns




* ` Iterable<Tv> ` - An `` Iterable that is a proper subset of the current ``Iterable``` up to ```n` elements.
<!-- HHAPIDOC -->
