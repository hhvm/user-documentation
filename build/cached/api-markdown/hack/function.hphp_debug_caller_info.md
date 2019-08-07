``` yamlmeta
{
    "name": "hphp_debug_caller_info",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/std/ext_std_errorfunc.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_error.hhi"
    ]
}
```




Retrieves information about the caller that invoked the current function or
method




``` Hack
function hphp_debug_caller_info(): darray<string, mixed>;
```




## Returns




+ ` array ` - - Returns an associative array. On success, the array will
  contain keys 'file', 'function', 'line' and optionally 'class' which
  indicate the filename, function, line number and class name (if in class
  context) of the callsite that invoked the current function or method.
<!-- HHAPIDOC -->
