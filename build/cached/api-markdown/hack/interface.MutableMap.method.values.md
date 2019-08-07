``` yamlmeta
{
    "name": "values",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableMap"
}
```




Returns a ` MutableVector ` containing the values of the current
`` MutableMap ``




``` Hack
public function values(): MutableVector<Tv>;
```




The indices of the ` MutableVector will be integer-indexed starting from 0, no matter the keys of the `MutableMap`.




## Returns




+ ` MutableVector<Tv> ` - a `` MutableVector `` containing the values of the current
  ``` MutableMap ```.
<!-- HHAPIDOC -->
