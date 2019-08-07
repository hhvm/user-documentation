``` yamlmeta
{
    "name": "skip",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/IteratorAggregate.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\Iterable"
}
```




Returns an ` Iterable ` containing the values after the `` n ``-th element of the
current ``` Iterable ```




``` Hack
public function skip(
  int $n,
): Iterable<Tv>;
```




The returned ` Iterable ` will always be a proper subset of the current
`` Iterable ``.




` $n ` is 1-based. So the first element is 1, the second 2, etc.




## Parameters




+ ` int $n ` - The last element to be skipped; the `` $n+1 `` element will be
  the first one in the returned ``` Iterable ```.




## Returns




* ` Iterable<Tv> ` - An `` Iterable `` that is a proper subset of the current ``` Iterable ```
  containing values after the specified ```` n ````-th element.
<!-- HHAPIDOC -->
