``` yamlmeta
{
    "name": "skip",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstSet"
}
```




Returns a ` ConstSet ` containing the values after the `` n ``-th element of the
current ``` ConstSet ```




``` Hack
public function skip(
  int $n,
): ConstSet<Tv>;
```




The returned ` ConstSet ` will always be a proper subset of the current
`` ConstSet ``.




` $n ` is 1-based. So the first element is 1, the second 2, etc.




## Parameters




+ ` int $n ` - The last element to be skipped; the `` $n+1 `` element will be the
  first one in the returned ``` ConstSet ```.




## Returns




* ` ConstSet<Tv> ` - A `` ConstSet `` that is a proper subset of the current ``` ConstSet ```
  containing values after the specified ```` n ````-th element.
<!-- HHAPIDOC -->
