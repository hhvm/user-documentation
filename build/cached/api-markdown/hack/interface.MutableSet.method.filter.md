``` yamlmeta
{
    "name": "filter",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableSet"
}
```




Returns a ` MutableSet ` containing the values of the current `` MutableSet ``
that meet a supplied condition applied to each value




``` Hack
public function filter(
  callable $fn,
): MutableSet<Tv>;
```




Only values that meet a certain criteria are affected by a call to
` filter() `, while all values are affected by a call to `` map() ``.




## Parameters




+ ` callable $fn ` - The callback containing the condition to apply to the
  current `` MutableSet `` values.




## Returns




* ` MutableSet<Tv> ` - a `` MutableSet `` containing the values after a user-specified
  condition is applied.
<!-- HHAPIDOC -->
