``` yamlmeta
{
    "name": "take",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/KeyedIterable.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\KeyedIterable"
}
```




Returns a ` KeyedIterable ` containing the first `` n `` values of the current
``` KeyedIterable ```




``` Hack
public function take(
  int $n,
): KeyedIterable<Tk, Tv>;
```




The returned ` KeyedIterable ` will always be a proper subset of the current
`` Iterable ``.




` $n ` is 1-based. So the first element is 1, the second 2, etc.




## Parameters




+ ` int $n ` - The last element that will be included in the returned
  `` KeyedIterable ``.




## Returns




* ` KeyedIterable<Tk, Tv> ` - A `` KeyedIterable that is a proper subset of the current ``KeyedIterable``` up to ```n` elements.
<!-- HHAPIDOC -->
