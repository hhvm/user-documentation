``` yamlmeta
{
    "name": "skip",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstMap"
}
```




Returns a ` ConstMap ` containing the values after the `` n ``-th element of the
current ``` ConstMap ```




``` Hack
public function skip(
  int $n,
): ConstMap<Tk, Tv>;
```




The returned ` ConstMap ` will always be a proper subset of the current
`` ConstMap ``.




` $n ` is 1-based. So the first element is 1, the second 2, etc.




## Parameters




+ ` int $n ` - The last element to be skipped; the `` $n+1 `` element will be the
  first one in the returned ``` ConstMap ```.




## Returns




* ` ConstMap<Tk, Tv> ` - A `` ConstMap `` that is a proper subset of the current ``` ConstMap ```
  containing values after the specified ```` n ````-th element.
<!-- HHAPIDOC -->
