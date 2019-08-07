``` yamlmeta
{
    "name": "skip",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/KeyedIterable.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\KeyedIterable"
}
```




Returns a ` KeyedIterable ` containing the values after the `` n ``-th element
of the current ``` KeyedIterable ```




``` Hack
public function skip(
  int $n,
): KeyedIterable<Tk, Tv>;
```




The returned ` KeyedIterable ` will always be a proper subset of the current
`` KeyedIterable ``.




` $n ` is 1-based. So the first element is 1, the second 2, etc.




## Parameters




+ ` int $n ` - The last element to be skipped; the `` $n+1 `` element will be
  the first one in the returned ``` KeyedIterable ```.




## Returns




* ` KeyedIterable<Tk, Tv> ` - A `` KeyedIterable `` that is a proper subset of the current
  ``` KeyedIterable ```  containing values after the specified ```` n ````-th
  element.
<!-- HHAPIDOC -->
