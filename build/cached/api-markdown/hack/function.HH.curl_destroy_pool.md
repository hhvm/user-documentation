``` yamlmeta
{
    "name": "HH\\curl_destroy_pool",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/curl/ext_curl.php"
    ]
}
```




Destroys a cURL connection pool




``` Hack
namespace HH;

function curl_destroy_pool(
  string $poolName,
): bool;
```




curl_init_pooled() calls that are
already waiting on a handle will still complete, but no new calls
will receive a pooled handle.




## Parameters




+ ` string $poolName ` - The name of the connection pool to destroy.




## Returns




* ` bool ` - - Returns true on success, or false if the pool does not
  exist.
<!-- HHAPIDOC -->
