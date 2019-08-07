``` yamlmeta
{
    "name": "slice",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/IteratorAggregate.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\Iterable"
}
```




Returns a subset of the current ` Iterable ` starting from a given key up
to, but not including, the element at the provided length from the
starting key




``` Hack
public function slice(
  int $start,
  int $len,
): Iterable<Tv>;
```




` $start ` is 0-based. `` $len `` is 1-based. So ``` slice(0, 2) ``` would return the
elements at key 0 and 1.




The returned ` Iterable ` will always be a proper subset of the current
`` Iterable ``.




## Parameters




+ ` int $start ` - The starting key of the current `` Iterable `` to begin the
  returned ``` Iterable ```.
+ ` int $len ` - The length of the returned `` Iterable ``.




## Returns




* ` Iterable<Tv> ` - An `` Iterable `` that is a proper subset of the current ``` Iterable ```
  starting at ```` $start ```` up to but not including the element
  ````` $start + $len `````.
<!-- HHAPIDOC -->
