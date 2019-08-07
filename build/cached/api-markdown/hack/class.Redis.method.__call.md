``` yamlmeta
{
    "name": "__call",
    "sources": [
        "api-sources/hhvm/hphp/system/php/redis/Redis.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_redis.hhi"
    ],
    "class": "Redis"
}
```




Dispatches all commands in the Redis::$map list




``` Hack
public function __call(
  $fname,
  $args,
);
```




All other commands are handled by explicit implementations




## Parameters




+ ` $fname `
+ ` $args `
<!-- HHAPIDOC -->
