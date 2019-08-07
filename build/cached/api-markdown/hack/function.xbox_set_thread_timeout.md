``` yamlmeta
{
    "name": "xbox_set_thread_timeout",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/server/ext_server.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_server.hhi"
    ]
}
```




Sets the timeout (maximum duration), in seconds, of the current xbox
thread




``` Hack
function xbox_set_thread_timeout(
  int $timeout,
): void;
```




The xbox thread would reset when this amount of time has passed
since the previous reset. Throws for non-xbox threads.




## Parameters




+ ` int $timeout ` - The new timeout (maximum duration).




## Returns




* ` void `
<!-- HHAPIDOC -->
