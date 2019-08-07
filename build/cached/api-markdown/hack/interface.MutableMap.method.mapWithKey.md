``` yamlmeta
{
    "name": "mapWithKey",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableMap"
}
```




Returns a ` MutableMap ` after an operation has been applied to each key and
value in the current `` MutableMap ``




``` Hack
public function mapWithKey<Tu>(
  callable $fn,
):     MutableMap<Tk, Tu>;
```




Every key and value in the current ` MutableMap ` is affected by a call to
`` mapWithKey() ``, unlike ``` filterWithKey() ``` where only values that meet a
certain criteria are affected.




The keys will remain unchanged from this ` MutableMap ` to the returned
`` MutableMap ``. The keys are only used to help in the mapping operation.




## Parameters




+ ` callable $fn ` - The callback containing the operation to apply to the current
  `` MutableMap `` keys and values.




## Returns




* ` MutableMap<Tk, Tu> ` - a `` MutableMap `` containing the values after a user-specified
  operation on the current ``` MutableMap ```'s keys and values is
  applied.
<!-- HHAPIDOC -->
