``` yamlmeta
{
    "name": "slice",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstVector"
}
```




Returns a subset of the current ` ConstVector ` starting from a given key up
to, but not including, the element at the provided length from the starting
key




``` Hack
public function slice(
  int $start,
  int $len,
): ConstVector<Tv>;
```




` $start ` is 0-based. $len is 1-based. So `` slice(0, 2) `` would return the
elements at key 0 and 1.




The returned ` ConstVector ` will always be a proper subset of this
`` ConstVector ``.




## Parameters




+ ` int $start ` - The starting key of this Vector to begin the returned
  `` ConstVector ``.
+ ` int $len ` - The length of the returned `` ConstVector ``.




## Returns




* ` ConstVector<Tv> ` - A `` ConstVector `` that is a proper subset of the current
  ``` ConstVector ``` starting at ```` $start ```` up to but not including the
  element ````` $start + $len `````.
<!-- HHAPIDOC -->
