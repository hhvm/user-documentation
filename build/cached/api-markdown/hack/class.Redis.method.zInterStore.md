``` yamlmeta
{
    "name": "zInterStore",
    "sources": [
        "api-sources/hhvm/hphp/system/php/redis/Redis.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_redis.hhi"
    ],
    "class": "Redis"
}
```




``` Hack
public function zInterStore(
  $key,
  array $keys,
  array $weights = NULL,
  $op = '',
);
```




## Parameters




+ ` $key `
+ ` array $keys `
+ ` array $weights = NULL `
+ ` $op = '' `
<!-- HHAPIDOC -->
