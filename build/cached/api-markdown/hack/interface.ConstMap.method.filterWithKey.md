``` yamlmeta
{
    "name": "filterWithKey",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstMap"
}
```




Returns a ` ConstMap ` containing the values of the current `` ConstMap `` that
meet a supplied condition applied to its keys and values




``` Hack
public function filterWithKey(
  callable $fn,
):     ConstMap<Tk, Tv>;
```




Only keys and values that meet a certain criteria are affected by a call to
` filterWithKey() `, while all values are affected by a call to
`` mapWithKey() ``.




The keys associated with the current ` ConstMap ` remain unchanged in the
returned `` ConstMap ``; the keys will be used in the filtering process only.




## Parameters




+ ` callable $fn ` - The callback containing the condition to apply to the current
  `` ConstMap `` keys and values.




## Returns




* ` ConstMap<Tk, Tv> ` - a `` ConstMap `` containing the values after a user-specified
  condition is applied to the keys and values of the current
  ``` ConstMap ```.
<!-- HHAPIDOC -->
