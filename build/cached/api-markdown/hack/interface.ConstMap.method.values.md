``` yamlmeta
{
    "name": "values",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstMap"
}
```




Returns a ` ConstVector ` containing the values of the current `` ConstMap ``




``` Hack
public function values(): ConstVector<Tv>;
```




The indices of the ` ConstVector will be integer-indexed starting from 0, no matter the keys of the `ConstMap`.




## Returns




+ ` ConstVector<Tv> ` - a `` ConstVector `` containing the values of the current ``` ConstMap ```.
<!-- HHAPIDOC -->
