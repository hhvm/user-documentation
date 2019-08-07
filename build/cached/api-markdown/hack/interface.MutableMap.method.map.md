``` yamlmeta
{
    "name": "map",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableMap"
}
```




Returns a ` MutableMap ` after an operation has been applied to each value
in the current `` MutableMap ``




``` Hack
public function map<Tu>(
  callable $fn,
): MutableMap<Tk, Tu>;
```




Every value in the current Map is affected by a call to ` map() `, unlike
`` filter() `` where only values that meet a certain criteria are affected.




The keys will remain unchanged from the current ` MutableMap ` to the
returned `` MutableMap ``.




## Parameters




+ ` callable $fn ` - The callback containing the operation to apply to the current
  `` MutableMap `` values.




## Returns




* ` MutableMap<Tk, Tu> ` - a `` MutableMap `` containing key/value pairs after a user-specified
  operation is applied.
<!-- HHAPIDOC -->
