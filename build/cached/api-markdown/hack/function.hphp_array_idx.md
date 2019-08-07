``` yamlmeta
{
    "name": "hphp_array_idx",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/array/ext_array.php"
    ]
}
```




hphp_array_idx() returns the value at the given key in the given array or
the given default value if it is not found




``` Hack
function hphp_array_idx(
  mixed $search,
  mixed $key,
  mixed $def,
): mixed;
```




An error will be raised if the
search parameter is not an array.




## Parameters




+ ` mixed $search ` - An array with keys to check.
+ ` mixed $key ` - Value to check.
+ ` mixed $def ` - The value to return if key is not found in search.




## Returns




* ` mixed ` - - Returns the value at 'key' in 'search' or 'def' if it is
  not found.
<!-- HHAPIDOC -->
