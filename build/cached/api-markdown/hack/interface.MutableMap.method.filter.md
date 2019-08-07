``` yamlmeta
{
    "name": "filter",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableMap"
}
```




Returns a ` MutableMap ` containing the values of the current `` MutableMap ``
that meet a supplied condition




``` Hack
public function filter(
  callable $fn,
): MutableMap<Tk, Tv>;
```




Only values that meet a certain criteria are affected by a call to
` filter() `, while all values are affected by a call to `` map() ``.




The keys associated with the current ` MutableMap ` remain unchanged in the
returned `` MutableMap ``.




## Parameters




+ ` callable $fn ` - The callback containing the condition to apply to the current
  `` MutableMap `` values.




## Returns




* ` MutableMap<Tk, Tv> ` - a Map containing the values after a user-specified condition
  is applied.
<!-- HHAPIDOC -->
