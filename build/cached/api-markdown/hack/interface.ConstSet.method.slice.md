``` yamlmeta
{
    "name": "slice",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstSet"
}
```




Returns a subset of the current ` ConstSet ` starting from a given key up
to, but not including, the element at the provided length from the
starting key




``` Hack
public function slice(
  int $start,
  int $len,
): ConstSet<Tv>;
```




` $start ` is 0-based. `` $len `` is 1-based. So ``` slice(0, 2) ``` would return the
elements at key 0 and 1.




The returned ` ConstSet ` will always be a proper subset of the current
`` ConstSet ``.




## Parameters




+ ` int $start ` - The starting value in the current `` ConstSet `` for the
  returned ``` ConstSet ```.
+ ` int $len ` - The length of the returned `` ConstSet ``.




## Returns




* ` ConstSet<Tv> ` - A `` ConstSet `` that is a proper subset of the current ``` ConstSet ```
  starting at ```` $start ```` up to but not including the element
  ````` $start + $len `````.
<!-- HHAPIDOC -->
