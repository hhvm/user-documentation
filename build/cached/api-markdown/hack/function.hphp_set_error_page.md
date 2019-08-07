``` yamlmeta
{
    "name": "hphp_set_error_page",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/std/ext_std_errorfunc.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_error.hhi"
    ]
}
```




Displays fatal errors with this PHP document




``` Hack
function hphp_set_error_page(
  string $page,
): void;
```




When 500 fatal error is about to display, it will invoke this PHP page with
all global states right at when the error happens. This is useful for
gracefully displaying something helpful information to end users when a fatal
error has happened. Otherwise, a blank page will be displayed by default.




## Parameters




+ ` string $page ` - Relative path of the PHP document.




## Returns




* ` void `
<!-- HHAPIDOC -->
