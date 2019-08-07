``` yamlmeta
{
    "name": "slice",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/KeyedIterable.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\KeyedIterable"
}
```




Returns a subset of the current ` KeyedIterable ` starting from a given key
up to, but not including, the element at the provided length from the
starting key




``` Hack
public function slice(
  int $start,
  int $len,
): KeyedIterable<Tk, Tv>;
```




` $start ` is 0-based. `` $len `` is 1-based. So ``` slice(0, 2) ``` would return the
elements at key 0 and 1.




The returned ` KeyedIterable ` will always be a proper subset of the current
`` KeyedIterable ``.




## Parameters




+ ` int $start ` - The starting key of the current `` KeyedIterable `` to begin
  the returned ``` KeyedIterable ```.
+ ` int $len ` - The length of the returned `` KeyedIterable ``.




## Returns




* ` KeyedIterable<Tk, Tv> ` - A `` KeyedIterable `` that is a proper subset of the current
  ``` KeyedIterable ``` starting at ```` $start ```` up to but not including the
  element ````` $start + $len `````.
<!-- HHAPIDOC -->
