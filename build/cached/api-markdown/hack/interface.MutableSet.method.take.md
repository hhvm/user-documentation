``` yamlmeta
{
    "name": "take",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableSet"
}
```




Returns a ` MutableSet ` containing the first `` n `` values of the current
``` MutableSet ```




``` Hack
public function take(
  int $n,
): MutableSet<Tv>;
```




The returned ` MutableSet ` will always be a proper subset of the current
`` MutableSet ``.




` $n ` is 1-based. So the first element is 1, the second 2, etc.




## Parameters




+ ` int $n ` - The last element that will be included in the `` MutableSet ``.




## Returns




* ` MutableSet<Tv> ` - A `` MutableSet `` that is a proper subset of the current
  ``` MutableSet ``` up to ```` n ```` elements.
<!-- HHAPIDOC -->
