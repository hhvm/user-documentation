``` yamlmeta
{
    "name": "skip",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableVector"
}
```




Returns a ` MutableVector ` containing the values after the `` n ``-th element of
the current ``` MutableVector ```




``` Hack
public function skip(
  int $n,
): MutableVector<Tv>;
```




The returned ` MutableVector ` will always be a proper subset of the current
`` MutableVector ``.




` $n ` is 1-based. So the first element is 1, the second 2, etc.




## Parameters




+ ` int $n ` - The last element to be skipped; the $n+1 element will be the
  first one in the returned `` MutableVector ``.




## Returns




* ` MutableVector<Tv> ` - A `` MutableVector `` that is a proper subset of the current
  ``` MutableVector ``` containing values after the specified ```` n ````-th
  element.
<!-- HHAPIDOC -->
