``` yamlmeta
{
    "name": "hphpd_break",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/debugger/ext_debugger.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_debugger.hhi"
    ]
}
```




``` Hack
function hphpd_break(
  bool $condition = true,
): void;
```




## Parameters




+ ` bool $condition = true `




## Returns




* ` void `
<!-- HHAPIDOC -->
