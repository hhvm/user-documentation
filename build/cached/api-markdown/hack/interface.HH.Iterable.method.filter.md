``` yamlmeta
{
    "name": "filter",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/IteratorAggregate.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\Iterable"
}
```




Returns an ` Iterable ` containing the values of the current `` Iterable `` that
meet a supplied condition




``` Hack
public function filter(
  callable $fn,
): Iterable<Tv>;
```




Only values that meet a certain criteria are affected by a call to
` filter() `, while all values are affected by a call to `` map() ``.




## Parameters




+ ` callable $fn ` - The callback containing the condition to apply to the
  `` Itearble `` values.




## Returns




* ` Iterable<Tv> ` - an `` Iterable `` containing the values after a user-specified
  condition is applied.
<!-- HHAPIDOC -->
