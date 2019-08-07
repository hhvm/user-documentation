``` yamlmeta
{
    "name": "remove",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "SetAccess"
}
```




Removes the provided value from the current ` Set `




``` Hack
public function remove(
  Tm $m,
): this;
```




If the value is not in the current ` Set `, the `` Set `` is unchanged.




It the current ` Set `, meaning changes  made to the current `` Set `` will be
reflected in the returned ``` Set ```.




## Parameters




+ ` Tm $m ` - The value to remove.




## Returns




* ` this ` - Returns itself.
<!-- HHAPIDOC -->
