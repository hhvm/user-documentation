``` yamlmeta
{
    "name": "map",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/IteratorAggregate.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\Iterable"
}
```




Returns an ` Iterable ` containing the values after an operation has been
applied to each value in the current `` Iterable ``




``` Hack
public function map<Tu>(
  callable $fn,
): Iterable<Tu>;
```




Every value in the current ` Iterable ` is affected by a call to `` map() ``,
unlike ``` filter() ``` where only values that meet a certain criteria are
affected.




## Parameters




+ ` callable $fn ` - The callback containing the operation to apply to the
  `` Iterable `` values.




## Returns




* ` Iterable<Tu> ` - an `` Iterable `` containing the values after a user-specified
  operation is applied.
<!-- HHAPIDOC -->
