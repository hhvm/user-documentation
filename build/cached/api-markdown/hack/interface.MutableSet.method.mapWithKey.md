``` yamlmeta
{
    "name": "mapWithKey",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableSet"
}
```




Returns a ` MutableSet ` containing the values after an operation has been
applied to each "key" and value in the current Set




``` Hack
public function mapWithKey<Tu as arraykey>(
  callable $fn,
): MutableSet<Tu>;
```




Since sets don't have keys, the callback uses the values as the keys
as well.




Every value in the current ` MutableSet ` is affected by a call to
`` mapWithKey() ``, unlike ``` filterWithKey() ``` where only values that meet a
certain criteria are affected.




## Parameters




+ ` callable $fn ` - The callback containing the operation to apply to the
  current `` MutableSet `` "keys" and values.




## Returns




* ` MutableSet<Tu> ` - a `` MutableSet `` containing the values after a user-specified
  operation on the current ``` MutableSet ```'s values is applied.
<!-- HHAPIDOC -->
