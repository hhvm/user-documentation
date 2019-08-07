``` yamlmeta
{
    "name": "pagelet_server_flush",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/server/ext_server.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_server.hhi"
    ]
}
```




Flush all the currently buffered output, so that the main thread can read
it with pagelet_server_task_result()




``` Hack
function pagelet_server_flush(): void;
```




This is only meaningful in a pagelet
thread.




## Returns




+ ` void `
<!-- HHAPIDOC -->
