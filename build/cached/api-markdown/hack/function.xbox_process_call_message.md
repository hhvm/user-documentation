``` yamlmeta
{
    "name": "xbox_process_call_message",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/server/ext_server.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_server.hhi"
    ]
}
```




This function is invoked by the xbox facility to start an xbox call task




``` Hack
function xbox_process_call_message(
  string $msg,
): mixed;
```




This function is not intended to be called directly by user code.




## Parameters




+ ` string $msg ` - The call message.




## Returns




* ` mixed ` - - The return value of the xbox call task.
<!-- HHAPIDOC -->
