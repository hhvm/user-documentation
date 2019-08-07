``` yamlmeta
{
    "name": "slice",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Returns a subset of the current ` ImmSet ` starting from a given key up to,
but not including, the element at the provided length from the starting
key




``` Hack
public function slice(
  int $start,
  int $len,
): ImmSet<Tv>;
```




` $start ` is 0-based. `` $len `` is 1-based. So ``` slice(0, 2) ``` would return the
elements at key 0 and 1.




The returned ` ImmSet ` will always be a proper subset of the current
`` ImmSet ``.




## Parameters




+ ` int $start ` - The starting value in the current `` ImmSet `` for the
  returned ``` ImmSet ```.
+ ` int $len ` - The length of the returned `` ImmSet ``.




## Returns




* ` ImmSet<Tv> ` - An `` ImmSet `` that is a proper subset of the current ``` ImmSet ```
  starting at ```` $start ```` up to but not including the element
  ````` $start + $len `````.




## Examples




See [` Set::slice `](</hack/reference/class/Set/slice/#examples>) for usage examples.
<!-- HHAPIDOC -->
