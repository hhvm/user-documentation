``` yamlmeta
{
    "name": "xbox_task_result",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/server/ext_server.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_server.hhi"
    ]
}
```




Block and wait for xbox task's result




``` Hack
function xbox_task_result(
  resource $task,
  int $timeout_ms,
  mixed &$ret,
): int;
```




## Parameters




+ ` resource $task ` - The xbox task object created by xbox_task_start().
+ ` int $timeout_ms ` - How many milli-seconds to wait.
+ ` mixed &$ret ` - xbox message processing function's return value.




## Returns




* ` int ` - - Response code following HTTP's responses. For example, 200
  for success and 500 for server error.
<!-- HHAPIDOC -->
