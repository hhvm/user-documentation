``` yamlmeta
{
    "name": "filterWithKey",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableVector"
}
```




Returns a ` MutableVector ` containing the values of the current
`` MutableVector `` that meet a supplied condition applied to its keys and
values




``` Hack
public function filterWithKey(
  callable $fn,
):     MutableVector<Tv>;
```




Only keys and values that meet a certain criteria are affected by a call to
` filterWithKey() `, while all values are affected by a call to
`` mapWithKey() ``.




## Parameters




+ ` callable $fn ` - The callback containing the condition to apply to the
  `` MutableVector `` keys and values.




## Returns




* ` MutableVector<Tv> ` - a `` MutableVector `` containing the values after a user-specified
  condition is applied to the keys and values of the current
  ``` MutableVector ```.
<!-- HHAPIDOC -->
