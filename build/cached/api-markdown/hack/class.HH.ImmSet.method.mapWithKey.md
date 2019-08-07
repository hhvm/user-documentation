``` yamlmeta
{
    "name": "mapWithKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Returns an ` ImmSet ` containing the values after an operation has been
applied to each "key" and value in the current `` ImmSet ``




``` Hack
public function mapWithKey<Tu as arraykey>(
  callable $callback,
): ImmSet<Tu>;
```




Since ` ImmSet `s don't have keys, the callback uses the values as the keys
as well.




Every value in the current ` ImmSet ` is affected by a call to
`` mapWithKey() ``, unlike ``` filterWithKey() ``` where only values that meet a
certain criteria are affected.




## Parameters




+ ` callable $callback ` - The callback containing the operation to apply to the
  current `` ImmSet `` keys and values.




## Returns




* ` ImmSet<Tu> ` - an `` ImmSet `` containing the values after a user-specified
  operation on the current ``` ImmSet ```'s values is applied.




## Examples




See [` Set::mapWithKey `](</hack/reference/class/Set/mapWithKey/#examples>) for usage examples.
<!-- HHAPIDOC -->
