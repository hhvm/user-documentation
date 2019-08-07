``` yamlmeta
{
    "name": "map",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Returns an ` ImmSet ` containing the values after an operation has been
applied to each value in the current `` ImmSet ``




``` Hack
public function map<Tu as arraykey>(
  callable $callback,
): ImmSet<Tu>;
```




Every value in the current ` ImmSet ` is affected by a call to `` map() ``,
unlike ``` filter() ``` where only values that meet a certain criteria are
affected.




## Parameters




+ ` callable $callback ` - The callback containing the operation to apply to the
  current `` ImmSet `` values.




## Returns




* ` ImmSet<Tu> ` - a `` ImmSet `` containing the values after a user-specified operation
  is applied.




## Examples




See [` Set::map `](</hack/reference/class/Set/map/#examples>) for usage examples.
<!-- HHAPIDOC -->
