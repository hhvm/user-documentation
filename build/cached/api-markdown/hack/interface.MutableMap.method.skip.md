``` yamlmeta
{
    "name": "skip",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableMap"
}
```




Returns a ` MutableMap ` containing the values after the `` n ``-th element of
the current ``` MutableMap ```




``` Hack
public function skip(
  int $n,
): MutableMap<Tk, Tv>;
```




The returned ` MutableMap ` will always be a proper subset of the current
`` MutableMap ``.




` $n ` is 1-based. So the first element is 1, the second 2, etc.




## Parameters




+ ` int $n ` - The last element to be skipped; the `` $n+1 `` element will be the
  first one in the returned ``` MutableMap ```.




## Returns




* ` MutableMap<Tk, Tv> ` - A `` MutableMap `` that is a proper subset of the current
  ``` MutableMap ``` containing values after the specified ```` n ````-th
  element.
<!-- HHAPIDOC -->
