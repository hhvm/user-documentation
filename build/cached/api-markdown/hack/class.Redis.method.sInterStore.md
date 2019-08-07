``` yamlmeta
{
    "name": "sInterStore",
    "sources": [
        "api-sources/hhvm/hphp/system/php/redis/Redis.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_redis.hhi"
    ],
    "class": "Redis"
}
```




``` Hack
public function sInterStore(
  $dstKey,
  $key1,
  $key2,
  $keyN = NULL,
);
```




## Parameters




+ ` $dstKey `
+ ` $key1 `
+ ` $key2 `
+ ` $keyN = NULL `
<!-- HHAPIDOC -->
