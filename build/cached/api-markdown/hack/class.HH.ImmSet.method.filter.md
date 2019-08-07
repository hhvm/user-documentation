``` yamlmeta
{
    "name": "filter",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Returns an ` ImmSet ` containing the values of the current `` ImmSet `` that
meet a supplied condition applied to each value




``` Hack
public function filter(
  callable $callback,
): ImmSet<Tv>;
```




Only values that meet a certain criteria are affected by a call to
` filter() `, while all values are affected by a call to `` map() ``.




## Parameters




+ ` callable $callback ` - The callback containing the condition to apply to the
  current `` ImmSet `` values.




## Returns




* ` ImmSet<Tv> ` - an `` ImmSet `` containing the values after a user-specified
  condition is applied.




## Examples




See [` Set::filter `](</hack/reference/class/Set/filter/#examples>) for usage examples.
<!-- HHAPIDOC -->
