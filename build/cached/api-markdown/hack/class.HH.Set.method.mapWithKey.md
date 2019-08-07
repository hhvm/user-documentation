``` yamlmeta
{
    "name": "mapWithKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Returns a ` Set ` containing the values after an operation has been applied
to each "key" and value in the current `` Set ``




``` Hack
public function mapWithKey<Tu as arraykey>(
  callable $callback,
): Set<Tu>;
```




Since ` Set `s don't have keys, the callback uses the values as the keys
as well.




Every value in the current ` Set ` is affected by a call to `` mapWithKey() ``,
unlike ``` filterWithKey() ``` where only values that meet a certain criteria are
affected.




## Parameters




+ ` callable $callback ` - The callback containing the operation to apply to the
  current `` Set `` keys and values.




## Returns




* ` Set<Tu> ` - a `` Set `` containing the values after a user-specified operation
  on the current ``` Set ```'s values is applied.
<!-- HHAPIDOC -->
