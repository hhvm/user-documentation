``` yamlmeta
{
    "name": "doConnect",
    "sources": [
        "api-sources/hhvm/hphp/system/php/redis/Redis.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_redis.hhi"
    ],
    "class": "Redis"
}
```




``` Hack
protected function doConnect(
  $host,
  $port,
  $timeout,
  $persistent_id,
  $retry_interval,
  $persistent = false,
);
```




## Parameters




+ ` $host `
+ ` $port `
+ ` $timeout `
+ ` $persistent_id `
+ ` $retry_interval `
+ ` $persistent = false `
<!-- HHAPIDOC -->
