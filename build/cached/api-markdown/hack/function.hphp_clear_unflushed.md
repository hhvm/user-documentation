``` yamlmeta
{
    "name": "hphp_clear_unflushed",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/std/ext_std_errorfunc.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_error.hhi"
    ]
}
```




Clears any output contents that have not been flushed to networked




``` Hack
function hphp_clear_unflushed(): void;
```




This is useful when handling a fatal error. Before displaying a customized
PHP page, one may call this function to clear previously written content, so
to replay what will be displayed.




## Returns




+ ` void `
<!-- HHAPIDOC -->
