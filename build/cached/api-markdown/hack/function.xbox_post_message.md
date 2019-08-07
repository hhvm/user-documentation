``` yamlmeta
{
    "name": "xbox_post_message",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/server/ext_server.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_server.hhi"
    ]
}
```




Posts an xbox message without waiting




``` Hack
function xbox_post_message(
  string $msg,
  string $host = 'localhost',
): bool;
```




Please read server documentation for
more details.




## Parameters




+ ` string $msg ` - The response.
+ ` string $host = 'localhost' ` - Which machine to post to.




## Returns




* ` bool ` - - TRUE if successful, FALSE otherwise.
<!-- HHAPIDOC -->
