``` yamlmeta
{
    "name": "migrate",
    "sources": [
        "api-sources/hhvm/hphp/system/php/redis/Redis.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_redis.hhi"
    ],
    "class": "Redis"
}
```




``` Hack
public function migrate(
  $host,
  $port,
  $key,
  $db,
  $timeout,
);
```




## Parameters




+ ` $host `
+ ` $port `
+ ` $key `
+ ` $db `
+ ` $timeout `
<!-- HHAPIDOC -->
