``` yamlmeta
{
    "name": "at",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstIndexAccess"
}
```




Returns the value at the specified key in the current collection




``` Hack
public function at(
  Tk $k,
): Tv;
```




If the key is not present, an exception is thrown. If you don't want an
exception to be thrown, use ` get() ` instead.




` $v = $vec->at($k) ` is semantically equivalent to `` $v = $vec[$k] ``.




## Parameters




+ ` Tk $k ` - the key from which to retrieve the value.




## Returns




* ` Tv ` - The value at the specified key; or an exception if the key does
  not exist.
<!-- HHAPIDOC -->
