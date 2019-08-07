``` yamlmeta
{
    "name": "filterWithKey",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableSet"
}
```




Returns a ` MutableSet ` containing the values of the current `` MutableSet ``
that meet a supplied condition applied to its "keys" and values




``` Hack
public function filterWithKey(
  callable $fn,
):     MutableSet<Tv>;
```




Since sets don't have keys, the callback uses the values as the keys
as well.




Only values that meet a certain criteria are affected by a call to
` filterWithKey() `, while all values are affected by a call to
`` mapWithKey() ``.




## Parameters




+ ` callable $fn ` - The callback containing the condition to apply to the
  current `` MutableSet `` "keys" and values.




## Returns




* ` MutableSet<Tv> ` - a `` MutableSet `` containing the values after a user-specified
  condition is applied to the values of the current ``` MutableSet ```.
<!-- HHAPIDOC -->
