``` yamlmeta
{
    "name": "filter",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstSet"
}
```




Returns a ` ConstSet ` containing the values of the current `` ConstSet `` that
meet a supplied condition applied to each value




``` Hack
public function filter(
  callable $fn,
): ConstSet<Tv>;
```




Only values that meet a certain criteria are affected by a call to
` filter() `, while all values are affected by a call to `` map() ``.




## Parameters




+ ` callable $fn ` - The callback containing the condition to apply to the
  current `` ConstSet `` values.




## Returns




* ` ConstSet<Tv> ` - a `` ConstSet `` containing the values after a user-specified
  condition is applied.
<!-- HHAPIDOC -->
