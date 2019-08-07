``` yamlmeta
{
    "name": "map",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstVector"
}
```




Returns a ` ConstVector ` containing the values after an operation has been
applied to each value in the current `` ConstVector ``




``` Hack
public function map<Tu>(
  callable $fn,
): ConstVector<Tu>;
```




Every value in the current ` ConstVector ` is affected by a call to `` map() ``,
unlike ``` filter() ``` where only values that meet a certain criteria are
affected.




## Parameters




+ ` callable $fn ` - The callback containing the operation to apply to the
  `` ConstVector `` values.




## Returns




* ` ConstVector<Tu> ` - a `` ConstVector `` containing the values after a user-specified
  operation is applied.
<!-- HHAPIDOC -->
