``` yamlmeta
{
    "name": "take",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstSet"
}
```




Returns a ` ConstSet ` containing the first `` n `` values of the current
``` ConstSet ```




``` Hack
public function take(
  int $n,
): ConstSet<Tv>;
```




The returned ` ConstSet ` will always be a proper subset of the current
`` ConstSet ``.




` $n ` is 1-based. So the first element is 1, the second 2, etc.




## Parameters




+ ` int $n ` - The last element that will be included in the `` ConstSet ``.




## Returns




* ` ConstSet<Tv> ` - A `` ConstSet `` that is a proper subset of the current ``` ConstSet ```
  up to ```` n ```` elements.
<!-- HHAPIDOC -->
