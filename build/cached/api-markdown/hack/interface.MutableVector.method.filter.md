``` yamlmeta
{
    "name": "filter",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableVector"
}
```




Returns a ` MutableVector ` containing the values of the current
`` MutableVector `` that meet a supplied condition




``` Hack
public function filter(
  callable $fn,
): MutableVector<Tv>;
```




Only values that meet a certain criteria are affected by a call to
` filter() `, while all values are affected by a call to `` map() ``.




## Parameters




+ ` callable $fn ` - The $callback containing the condition to apply to the
  `` MutableVector `` values.




## Returns




* ` MutableVector<Tv> ` - a `` MutableVector `` containing the values after a user-specified
  condition is applied.
<!-- HHAPIDOC -->
