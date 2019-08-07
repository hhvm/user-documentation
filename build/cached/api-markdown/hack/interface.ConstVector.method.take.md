``` yamlmeta
{
    "name": "take",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstVector"
}
```




Returns a ` ConstVector ` containing the first `` n `` values of the current
``` ConstVector ```




``` Hack
public function take(
  int $n,
): ConstVector<Tv>;
```




The returned ` ConstVector ` will always be a proper subset of the current
`` ConstVector ``.




` $n ` is 1-based. So the first element is 1, the second 2, etc.




## Parameters




+ ` int $n ` - The last element that will be included in the returned
  `` ConstVector ``.




## Returns




* ` ConstVector<Tv> ` - A `` ConstVector `` that is a proper subset of the current
  ``` ConstVector ``` up to ```` n ```` elements.
<!-- HHAPIDOC -->
