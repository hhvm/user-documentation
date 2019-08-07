``` yamlmeta
{
    "name": "zRangeByScoreImpl",
    "sources": [
        "api-sources/hhvm/hphp/system/php/redis/Redis.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_redis.hhi"
    ],
    "class": "Redis"
}
```




``` Hack
protected function zRangeByScoreImpl(
  $cmd,
  $key,
  $start,
  $end,
  array $opts = NULL,
);
```




## Parameters




+ ` $cmd `
+ ` $key `
+ ` $start `
+ ` $end `
+ ` array $opts = NULL `
<!-- HHAPIDOC -->
