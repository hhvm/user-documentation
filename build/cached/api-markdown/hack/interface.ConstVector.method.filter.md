``` yamlmeta
{
    "name": "filter",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstVector"
}
```




Returns a ` ConstVector ` containing the values of the current `` ConstVector ``
that meet a supplied condition




``` Hack
public function filter(
  callable $fn,
): ConstVector<Tv>;
```




Only values that meet a certain criteria are affected by a call to
` filter() `, while all values are affected by a call to `` map() ``.




## Parameters




+ ` callable $fn ` - The $callback containing the condition to apply to the
  `` ConstVector `` values.




## Returns




* ` ConstVector<Tv> ` - a `` ConstVector `` containing the values after a user-specified
  condition is applied.
<!-- HHAPIDOC -->
