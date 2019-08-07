``` yamlmeta
{
    "name": "take",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstMap"
}
```




Returns a ` ConstMap ` containing the first `` n `` key/values of the current
``` ConstMap ```




``` Hack
public function take(
  int $n,
): ConstMap<Tk, Tv>;
```




The returned ` ConstMap ` will always be a proper subset of the current
`` ConstMap ``.




` $n ` is 1-based. So the first element is 1, the second 2, etc.




## Parameters




+ ` int $n ` - The last element that will be included in the `` ConstMap ``.




## Returns




* ` ConstMap<Tk, Tv> ` - A `` ConstMap `` that is a proper subset of the current ``` ConstMap ```
  up to ```` n ```` elements.
<!-- HHAPIDOC -->
