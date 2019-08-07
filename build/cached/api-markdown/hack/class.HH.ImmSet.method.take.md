``` yamlmeta
{
    "name": "take",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Returns an ` ImmSet ` containing the first n values of the current `` ImmSet ``




``` Hack
public function take(
  int $n,
): ImmSet<Tv>;
```




The returned ` ImmSet ` will always be a proper subset of the current
`` ImmSet ``.




` n ` is 1-based. So the first element is 1, the second 2, etc.




## Parameters




+ ` int $n ` - The last element that will be included in the returned
  `` ImmSet ``.




## Returns




* ` ImmSet<Tv> ` - An `` ImmSet `` that is a proper subset of the current ``` ImmSet ``` up
  to ```` n ```` elements.




## Examples




See [` Set::take `](</hack/reference/class/Set/take/#examples>) for usage examples.
<!-- HHAPIDOC -->
