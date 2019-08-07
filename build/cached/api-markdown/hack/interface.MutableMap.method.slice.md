``` yamlmeta
{
    "name": "slice",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableMap"
}
```




Returns a subset of the current ` MutableMap ` starting from a given key
location up to, but not including, the element at the provided length from
the starting key location




``` Hack
public function slice(
  int $start,
  int $len,
): MutableMap<Tk, Tv>;
```




` $start ` is 0-based. `` $len `` is 1-based. So ``` slice(0, 2) ``` would return the
keys and values at key location 0 and 1.




The returned ` MutableMap ` will always be a proper subset of the current
`` MutableMap ``.




## Parameters




+ ` int $start ` - The starting key location of the current `` MutableMap `` for
  the feturned ``` MutableMap ```.
+ ` int $len ` - The length of the returned `` MutableMap ``.




## Returns




* ` MutableMap<Tk, Tv> ` - A `` MutableMap `` that is a proper subset of the current
  ``` MutableMap ``` starting at ```` $start ```` up to but not including the
  element ````` $start + $len `````.
<!-- HHAPIDOC -->
