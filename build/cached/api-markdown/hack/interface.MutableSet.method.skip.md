``` yamlmeta
{
    "name": "skip",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableSet"
}
```




Returns a ` MutableSet ` containing the values after the `` n ``-th element of
the current ``` MutableSet ```




``` Hack
public function skip(
  int $n,
): MutableSet<Tv>;
```




The returned ` MutableSet ` will always be a proper subset of the current
`` MutableSet ``.




` $n ` is 1-based. So the first element is 1, the second 2, etc.




## Parameters




+ ` int $n ` - The last element to be skipped; the `` $n+1 `` element will be the
  first one in the returned ``` MutableSet ```.




## Returns




* ` MutableSet<Tv> ` - A `` MutableSet `` that is a proper subset of the current
  ``` MutableSet ``` containing values after the specified ```` n ````-th
  element.
<!-- HHAPIDOC -->
