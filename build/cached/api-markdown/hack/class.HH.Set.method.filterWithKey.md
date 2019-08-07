``` yamlmeta
{
    "name": "filterWithKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Returns a ` Set ` containing the values of the current `` Set `` that meet
a supplied condition applied to its "keys" and values




``` Hack
public function filterWithKey(
  callable $callback,
): Set<Tv>;
```




Since ` Set `s don't have keys, the callback uses the values as the keys
as well.




Only values that meet a certain criteria are affected by a call to
` filterWithKey() `, while all values are affected by a call to
`` mapWithKey() ``.




## Parameters




+ ` callable $callback ` - The callback containing the condition to apply to the
  current `` Set `` keys and values.




## Returns




* ` Set<Tv> ` - a `` Set `` containing the values after a user-specified condition
  is applied to the values of the current ``` Set ```.
<!-- HHAPIDOC -->
