``` yamlmeta
{
    "name": "zAdd",
    "sources": [
        "api-sources/hhvm/hphp/system/php/redis/Redis.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_redis.hhi"
    ],
    "class": "Redis"
}
```




``` Hack
public function zAdd(
  $key,
  $score1,
  $value1,
  ...$more_scores = NULL,
);
```




## Parameters




+ ` $key `
+ ` $score1 `
+ ` $value1 `
+ ` ...$more_scores = NULL `
<!-- HHAPIDOC -->
