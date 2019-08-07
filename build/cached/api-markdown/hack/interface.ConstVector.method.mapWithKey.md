``` yamlmeta
{
    "name": "mapWithKey",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstVector"
}
```




Returns a ` ConstVector ` containing the values after an operation has been
applied to each key and value in the current `` ConstVector ``




``` Hack
public function mapWithKey<Tu>(
  callable $fn,
):     ConstVector<Tu>;
```




Every key and value in the current ` ConstVector ` is affected by a call to
`` mapWithKey() ``, unlike ``` filterWithKey() ``` where only values that meet a
certain criteria are affected.




## Parameters




+ ` callable $fn ` - The callback containing the operation to apply to the
  `` ConstVector `` keys and values.




## Returns




* ` ConstVector<Tu> ` - a `` ConstVector `` containing the values after a user-specified
  operation on the current Vector's keys and values is applied.
<!-- HHAPIDOC -->
