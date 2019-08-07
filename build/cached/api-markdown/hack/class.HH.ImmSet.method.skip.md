``` yamlmeta
{
    "name": "skip",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Returns an ` ImmSet ` containing the values after the `` n ``-th element of the
current ``` ImmSet ```




``` Hack
public function skip(
  int $n,
): ImmSet<Tv>;
```




The returned ` ImmSet ` will always be a proper subset of the current
`` ImmSet ``.




` n ` is 1-based. So the first element is 1, the second 2, etc.




## Parameters




+ ` int $n ` - The last element to be skipped; the `` $n+1 `` element will be the
  first one in the returned ``` ImmSet ```.




## Returns




* ` ImmSet<Tv> ` - An `` ImmSet `` that is a proper subset of the current ``` ImmSet ```
  containing values after the specified ```` n ````-th element.




## Examples




See [` Set::skip `](</hack/reference/class/Set/skip/#examples>) for usage examples.
<!-- HHAPIDOC -->
