``` yamlmeta
{
    "name": "xbox_get_thread_time",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/server/ext_server.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_server.hhi"
    ]
}
```




Returns the time that the current xbox thread has been running without a
reset, in seconds, and throws for non-xbox threads




``` Hack
function xbox_get_thread_time(): int;
```




## Returns




+ ` int ` - - The time that the current xbox thread has been running
  without a reset.
<!-- HHAPIDOC -->
