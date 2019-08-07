``` yamlmeta
{
    "name": "mapWithKey",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstMap"
}
```




Returns a ` ConstMap ` after an operation has been applied to each key and
value in the current `` ConstMap ``




``` Hack
public function mapWithKey<Tu>(
  callable $fn,
):     ConstMap<Tk, Tu>;
```




Every key and value in the current ` ConstMap ` is affected by a call to
`` mapWithKey() ``, unlike ``` filterWithKey() ``` where only values that meet a
certain criteria are affected.




The keys will remain unchanged from this ` ConstMap ` to the returned
`` ConstMap ``. The keys are only used to help in the mapping operation.




## Parameters




+ ` callable $fn ` - The callback containing the operation to apply to the current
  `` ConstMap `` keys and values.




## Returns




* ` ConstMap<Tk, Tu> ` - a `` ConstMap `` containing the values after a user-specified
  operation on the current ``` ConstMap ```'s keys and values is applied.
<!-- HHAPIDOC -->
