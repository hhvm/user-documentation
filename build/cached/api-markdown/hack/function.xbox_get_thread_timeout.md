``` yamlmeta
{
    "name": "xbox_get_thread_timeout",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/server/ext_server.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_server.hhi"
    ]
}
```




Gets the timeout (maximum duration), in seconds, of the current xbox
thread




``` Hack
function xbox_get_thread_timeout(): int;
```




Throws for non-xbox threads.




## Returns




+ ` int ` - - The current timeout (maximum duration).
<!-- HHAPIDOC -->
