``` yamlmeta
{
    "name": "pagelet_server_is_enabled",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/server/ext_server.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_server.hhi"
    ]
}
```




Whether pagelet server is enabled or not




``` Hack
function pagelet_server_is_enabled(): bool;
```




Please read server documentation
for what a pagelet server is.




## Returns




+ ` bool ` - - TRUE if it's enabled, FALSE otherwise.
<!-- HHAPIDOC -->
