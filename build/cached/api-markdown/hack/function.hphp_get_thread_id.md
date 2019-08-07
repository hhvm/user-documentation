``` yamlmeta
{
    "name": "hphp_get_thread_id",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/thread/ext_thread.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_thread.hhi"
    ]
}
```




Gets current thread's ID




``` Hack
function hphp_get_thread_id(): int;
```




## Returns




+ ` int ` - - The pthread_self() return.
<!-- HHAPIDOC -->
