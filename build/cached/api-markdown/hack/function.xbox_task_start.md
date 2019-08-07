``` yamlmeta
{
    "name": "xbox_task_start",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/server/ext_server.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_server.hhi"
    ]
}
```




Starts a local xbox task




``` Hack
function xbox_task_start(
  string $message,
): resource;
```




## Parameters




+ ` string $message ` - A message to send to xbox's message processing
  function.




## Returns




* ` resource ` - - A task handle xbox_task_status() and xbox_task_result()
  can use.
<!-- HHAPIDOC -->
