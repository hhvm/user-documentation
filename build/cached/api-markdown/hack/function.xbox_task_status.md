``` yamlmeta
{
    "name": "xbox_task_status",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/server/ext_server.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_server.hhi"
    ]
}
```




Checks an xbox task's status




``` Hack
function xbox_task_status(
  resource $task,
): bool;
```




## Parameters




+ ` resource $task ` - The xbox task object created by xbox_task_start().




## Returns




* ` bool ` - - TRUE if finished, FALSE otherwise.
<!-- HHAPIDOC -->
