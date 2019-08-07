``` yamlmeta
{
    "name": "xbox_schedule_thread_reset",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/server/ext_server.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_server.hhi"
    ]
}
```




Schedules a reset of the current xbox thread, when the next request comes
in




``` Hack
function xbox_schedule_thread_reset(): void;
```




Throws for non-xbox threads.




## Returns




+ ` void `
<!-- HHAPIDOC -->
