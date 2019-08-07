``` yamlmeta
{
    "name": "map",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstMap"
}
```




Returns a ` ConstMap ` after an operation has been applied to each value in
the current `` ConstMap ``




``` Hack
public function map<Tu>(
  callable $fn,
): ConstMap<Tk, Tu>;
```




Every value in the current Map is affected by a call to ` map() `, unlike
`` filter() `` where only values that meet a certain criteria are affected.




The keys will remain unchanged from the current ` ConstMap ` to the returned
`` ConstMap ``.




## Parameters




+ ` callable $fn ` - The callback containing the operation to apply to the current
  `` ConstMap `` values.




## Returns




* ` ConstMap<Tk, Tu> ` - a `` ConstMap `` containing key/value pairs after a user-specified
  operation is applied.
<!-- HHAPIDOC -->
