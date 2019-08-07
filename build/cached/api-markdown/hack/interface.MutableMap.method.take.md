``` yamlmeta
{
    "name": "take",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableMap"
}
```




Returns a ` MutableMap ` containing the first `` n `` key/values of the current
``` MutableMap ```




``` Hack
public function take(
  int $n,
): MutableMap<Tk, Tv>;
```




The returned ` MutableMap ` will always be a proper subset of the current
`` MutableMap ``.




` $n ` is 1-based. So the first element is 1, the second 2, etc.




## Parameters




+ ` int $n ` - The last element that will be included in the `` MutableMap ``.




## Returns




* ` MutableMap<Tk, Tv> ` - A `` MutableMap `` that is a proper subset of the current
  ``` MutableMap ``` up to ```` n ```` elements.
<!-- HHAPIDOC -->
