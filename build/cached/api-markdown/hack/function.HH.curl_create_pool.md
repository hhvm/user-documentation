``` yamlmeta
{
    "name": "HH\\curl_create_pool",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/curl/ext_curl.php"
    ]
}
```




Create a new cURL pool for use with curl_init_pooled




``` Hack
namespace HH;

function curl_create_pool(
  string $poolName,
  int $size = 5,
  int $connGetTimeout = 5000,
  int $reuseLimit = 500,
): \void;
```




If a pool of
this name already exists it will be replaced.




## Parameters




+ ` string $poolName ` = The name of the connection pool to create.
+ ` int $size = 5 ` - The number of connections the pool will hold
+ ` int $connGetTimeout = 5000 ` - The maximum time curl_init_pooled() will wait
  for a connection to become available before throwing a RuntimeException
+ ` int $reuseLimit = 500 ` - The number of times a connection will be reused
  before being recycled.




## Returns




* ` \void `
<!-- HHAPIDOC -->
