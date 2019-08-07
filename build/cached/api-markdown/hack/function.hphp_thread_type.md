``` yamlmeta
{
    "name": "hphp_thread_type",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/server/ext_server.php"
    ]
}
```




Return thread type




``` Hack
function hphp_thread_type(): int;
```




See enum class ThreadType.




## Returns




+ ` int ` - - thread type. Returns -1 if unknown.
<!-- HHAPIDOC -->
