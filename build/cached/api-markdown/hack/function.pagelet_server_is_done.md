``` yamlmeta
{
    "name": "pagelet_server_is_done",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/server/ext_server.php"
    ]
}
```




Determine whether or not the pagelet thread we are executing on has finished
and closed its output buffer




``` Hack
function pagelet_server_is_done(): bool;
```




## Returns




+ ` bool `
<!-- HHAPIDOC -->
