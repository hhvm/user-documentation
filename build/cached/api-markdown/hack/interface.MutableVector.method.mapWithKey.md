``` yamlmeta
{
    "name": "mapWithKey",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableVector"
}
```




Returns a ` MutableVector ` containing the values after an operation has been
applied to each key and value in the current `` MutableVector ``




``` Hack
public function mapWithKey<Tu>(
  callable $fn,
):     MutableVector<Tu>;
```




Every key and value in the current ` MutableVector ` is affected by a call to
`` mapWithKey() ``, unlike ``` filterWithKey() ``` where only values that meet a
certain criteria are affected.




## Parameters




+ ` callable $fn ` - The callback containing the operation to apply to the
  `` MutableVector `` keys and values.




## Returns




* ` MutableVector<Tu> ` - a `` MutableVector `` containing the values after a user-specified
  operation on the current Vector's keys and values is applied.
<!-- HHAPIDOC -->
