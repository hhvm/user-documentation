``` yamlmeta
{
    "name": "at",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmVector.hhi"
    ],
    "class": "HH\\ImmVector"
}
```




Returns the value at the specified key in the current ` ImmVector `




``` Hack
public function at(
  int $key,
): Tv;
```




If the key is not present, an exception is thrown. If you don't want an
exception to be thrown, use ` get() ` instead.




` $v = $vec->at($k) ` is semantically equivalent to `` $v = $vec[$k] ``.




## Parameters




+ ` int $key `




## Returns




* ` Tv ` - The value at the specified key; or an exception if the key does
  not exist.




## Examples




See [` Vector::at `](</hack/reference/class/Vector/at/#examples>) for usage examples.
<!-- HHAPIDOC -->
