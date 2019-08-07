``` yamlmeta
{
    "name": "map",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstSet"
}
```




Returns a ` ConstSet ` containing the values after an operation has been
applied to each value in the current `` ConstSet ``




``` Hack
public function map<Tu as arraykey>(
  callable $fn,
): ConstSet<Tu>;
```




Every value in the current ` ConstSet ` is affected by a call to `` map() ``,
unlike ``` filter() ``` where only values that meet a certain criteria are
affected.




## Parameters




+ ` callable $fn ` - The callback containing the operation to apply to the
  current `` ConstSet `` values.




## Returns




* ` ConstSet<Tu> ` - a `` ConstSet `` containing the values after a user-specified
  operation is applied.
<!-- HHAPIDOC -->
