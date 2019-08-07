``` yamlmeta
{
    "name": "map",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableSet"
}
```




Returns a ` MutableSet ` containing the values after an operation has been
applied to each value in the current `` MutableSet ``




``` Hack
public function map<Tu as arraykey>(
  callable $fn,
): MutableSet<Tu>;
```




Every value in the current ` MutableSet ` is affected by a call to `` map() ``,
unlike ``` filter() ``` where only values that meet a certain criteria are
affected.




## Parameters




+ ` callable $fn ` - The callback containing the operation to apply to the
  current `` MutableSet `` values.




## Returns




* ` MutableSet<Tu> ` - a `` MutableSet `` containing the values after a user-specified
  operation is applied.
<!-- HHAPIDOC -->
