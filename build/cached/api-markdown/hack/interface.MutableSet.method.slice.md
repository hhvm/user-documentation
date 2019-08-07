``` yamlmeta
{
    "name": "slice",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableSet"
}
```




Returns a subset of the current ` MutableSet ` starting from a given key up
to, but not including, the element at the provided length from the
starting key




``` Hack
public function slice(
  int $start,
  int $len,
): MutableSet<Tv>;
```




` $start ` is 0-based. `` $len `` is 1-based. So ``` slice(0, 2) ``` would return the
elements at key 0 and 1.




The returned ` MutableSet ` will always be a proper subset of the current
`` MutableSet ``.




## Parameters




+ ` int $start ` - The starting value in the current `` MutableSet `` for the
  returned ``` MutableSet ```.
+ ` int $len ` - The length of the returned `` MutableSet ``.




## Returns




* ` MutableSet<Tv> ` - A `` MutableSet `` that is a proper subset of the current
  ``` MutableSet ``` starting at ```` $start ```` up to but not including the
  element ````` $start + $len `````.
<!-- HHAPIDOC -->
