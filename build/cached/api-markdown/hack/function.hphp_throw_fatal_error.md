``` yamlmeta
{
    "name": "hphp_throw_fatal_error",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/std/ext_std_errorfunc.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_error.hhi"
    ]
}
```




Raises a fatal error




``` Hack
function hphp_throw_fatal_error(
  string $error_msg,
): void;
```




## Parameters




+ ` string $error_msg ` - The error message for the fatal.




## Returns




* ` void `
<!-- HHAPIDOC -->
