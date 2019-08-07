``` yamlmeta
{
    "name": "xbox_send_message",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/server/ext_server.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_server.hhi"
    ]
}
```




Sends an xbox message and waits for response




``` Hack
function xbox_send_message(
  string $msg,
  mixed &$ret,
  int $timeout_ms,
  string $host = 'localhost',
): bool;
```




Please read server
documentation for what an xbox is.




## Parameters




+ ` string $msg ` - The message.
+ ` mixed &$ret ` - The response.
+ ` int $timeout_ms ` - How many milli-seconds to wait.
+ ` string $host = 'localhost' ` - Which machine to send to.




## Returns




* ` bool ` - - TRUE if successful, FALSE otherwise.
<!-- HHAPIDOC -->
