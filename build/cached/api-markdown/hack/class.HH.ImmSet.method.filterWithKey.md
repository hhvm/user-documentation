``` yamlmeta
{
    "name": "filterWithKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Returns an ` ImmSet ` containing the values of the current `` ImmSet `` that
meet a supplied condition applied to its "keys" and values




``` Hack
public function filterWithKey(
  callable $callback,
):     ImmSet<Tv>;
```




Since ` ImmSet `s don't have keys, the callback uses the values as the keys
as well.




Only values that meet a certain criteria are affected by a call to
` filterWithKey() `, while all values are affected by a call to
`` mapWithKey() ``.




## Parameters




+ ` callable $callback ` - The callback containing the condition to apply to the
  current `` ImmSet `` keys and values.




## Returns




* ` ImmSet<Tv> ` - an `` ImmSet `` containing the values after a user-specified
  condition is applied to the values of the current ``` ImmSet ```.




## Examples




See [` Set::filterWithKey `](</hack/reference/class/Set/filterWithKey/#examples>) for usage examples.
<!-- HHAPIDOC -->
