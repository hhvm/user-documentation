``` yamlmeta
{
    "name": "removeKey",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "IndexAccess"
}
```




Removes the specified key (and associated value) from the current
collection




``` Hack
public function removeKey(
  Tk $k,
): this;
```




If the key is not in the current collection, the current collection is
unchanged.




It the current collection, meaning changes made to the current collection
will be reflected in the returned collection.




## Parameters




+ ` Tk $k ` - The key to remove.




## Returns




* ` this ` - Returns itself.
<!-- HHAPIDOC -->
