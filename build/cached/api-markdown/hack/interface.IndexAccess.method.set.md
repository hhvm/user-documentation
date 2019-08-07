``` yamlmeta
{
    "name": "set",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "IndexAccess"
}
```




Stores a value into the current collection with the specified key,
overwriting the previous value associated with the key




``` Hack
public function set(
  Tk $k,
  Tv $v,
): this;
```




If the key is not present, an exception is thrown. If you want to add
a value even if a key is not present, use ` add() `.




` $coll->set($k,$v) ` is semantically equivalent to `` $coll[$k] = $v ``
(except that ``` set() ``` returns the current collection).




It returns the current collection, meaning changes made to the current
collection will be reflected in the returned collection.




## Parameters




+ ` Tk $k ` - The key to which we will set the value.
+ ` Tv $v ` - The value to set.




## Returns




* ` this ` - Returns itself.
<!-- HHAPIDOC -->
