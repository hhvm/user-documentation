``` yamlmeta
{
    "name": "pagelet_server_task_status",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/server/ext_server.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_server.hhi"
    ]
}
```




Checks finish status of a pagelet task




``` Hack
function pagelet_server_task_status(
  resource $task,
): int;
```




## Parameters




+ ` resource $task ` - The pagelet task handle returned from
  pagelet_server_task_start().




## Returns




* ` int ` - - PAGELET_NOT_READY if there is no data available,
  PAGELET_READY if (partial) data is available from pagelet_server_flush(),
  and PAGELET_DONE if the pagelet request is done.
<!-- HHAPIDOC -->
