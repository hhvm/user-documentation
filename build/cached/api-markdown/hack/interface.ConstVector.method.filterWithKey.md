``` yamlmeta
{
    "name": "filterWithKey",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstVector"
}
```




Returns a ` ConstVector ` containing the values of the current `` ConstVector ``
that meet a supplied condition applied to its keys and values




``` Hack
public function filterWithKey(
  callable $fn,
):     ConstVector<Tv>;
```




Only keys and values that meet a certain criteria are affected by a call to
` filterWithKey() `, while all values are affected by a call to
`` mapWithKey() ``.




## Parameters




+ ` callable $fn ` - The callback containing the condition to apply to the
  `` ConstVector `` keys and values.




## Returns




* ` ConstVector<Tv> ` - a `` ConstVector `` containing the values after a user-specified
  condition is applied to the keys and values of the current
  ``` ConstVector ```.
<!-- HHAPIDOC -->
