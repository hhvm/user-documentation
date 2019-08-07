``` yamlmeta
{
    "name": "HH\\array_key_cast",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/array/ext_array.php"
    ]
}
```




array_key_cast() can be used to convert a given value to the equivalent
that would be used if that value was used as a key in an array




``` Hack
namespace HH;

function array_key_cast(
  mixed $key,
): \arraykey;
```




An integer is returned unchanged. A boolean, float, or resource is cast to
an integer (using standard semantics). A null is converted to an empty
string. A string is converted to an integer if it represents an integer
value, returned unchanged otherwise.




For object, array, vec, dict, or keyset values, an InvalidArgumentException
is thrown (as these cannot be used as array keys).




## Parameters




+ ` mixed $key ` - The value to be converted.




## Returns




* ` arraykey ` - - Returns the converted value.
<!-- HHAPIDOC -->
