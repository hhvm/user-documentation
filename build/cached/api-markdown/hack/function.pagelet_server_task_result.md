``` yamlmeta
{
    "name": "pagelet_server_task_result",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/server/ext_server.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_server.hhi"
    ]
}
```




Block and wait until pagelet task finishes or times out




``` Hack
function pagelet_server_task_result(
  resource $task,
  mixed &$headers,
  mixed &$code,
  int $timeout_ms = 0,
): string;
```




## Parameters




+ ` resource $task ` - The pagelet task handle returned from
  pagelet_server_task_start().
+ ` mixed &$headers ` - HTTP response headers.
+ ` mixed &$code ` - HTTP response code. Set to -1 in the event of a
  timeout.
+ ` int $timeout_ms = 0 ` - How many milliseconds to wait. A timeout of zero
  is interpreted as an infinite timeout.




## Returns




* ` string ` - - HTTP response from the pagelet.
<!-- HHAPIDOC -->
