``` yamlmeta
{
    "name": "filterWithKey",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstSet"
}
```




Returns a ` ConstSet ` containing the values of the current `` ConstSet `` that
meet a supplied condition applied to its "keys" and values




``` Hack
public function filterWithKey(
  callable $fn,
): ConstSet<Tv>;
```




Since sets don't have keys, the callback uses the values as the keys
as well.




Only values that meet a certain criteria are affected by a call to
` filterWithKey() `, while all values are affected by a call to
`` mapWithKey() ``.




## Parameters




+ ` callable $fn ` - The callback containing the condition to apply to the
  current `` ConstSet `` "keys" and values.




## Returns




* ` ConstSet<Tv> ` - a `` ConstSet `` containing the values after a user-specified
  condition is applied to the values of the current ``` ConstSet ```.
<!-- HHAPIDOC -->
