``` yamlmeta
{
    "name": "hphp_gettid",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/thread/ext_thread.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_thread.hhi"
    ]
}
```




Gets the kernel thread id of the current running thread




``` Hack
function hphp_gettid(): int;
```




## Returns




+ ` int ` - - The tid of the current running thread. In Linux, this is
  gettid()
<!-- HHAPIDOC -->
