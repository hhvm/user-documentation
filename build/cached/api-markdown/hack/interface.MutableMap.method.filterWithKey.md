``` yamlmeta
{
    "name": "filterWithKey",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableMap"
}
```




Returns a ` MutableMap ` containing the values of the current `` MutableMap ``
that meet a supplied condition applied to its keys and values




``` Hack
public function filterWithKey(
  callable $fn,
):     MutableMap<Tk, Tv>;
```




Only keys and values that meet a certain criteria are affected by a call
to ` filterWithKey() `, while all values are affected by a call to
`` mapWithKey() ``.




The keys associated with the current ` MutableMap ` remain unchanged in the
returned `` MutableMap ``; the keys will be used in the filtering process only.




## Parameters




+ ` callable $fn ` - The callback containing the condition to apply to the current
  `` MutableMap `` keys and values.




## Returns




* ` MutableMap<Tk, Tv> ` - a `` MutableMap `` containing the values after a user-specified
  condition is applied to the keys and values of the current
  ``` MutableMap ```.
<!-- HHAPIDOC -->
