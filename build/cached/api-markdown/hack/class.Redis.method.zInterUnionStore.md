``` yamlmeta
{
    "name": "zInterUnionStore",
    "sources": [
        "api-sources/hhvm/hphp/system/php/redis/Redis.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_redis.hhi"
    ],
    "class": "Redis"
}
```




``` Hack
protected function zInterUnionStore(
  $cmd,
  $key,
  array $keys,
  array $weights = NULL,
  $op = '',
);
```




## Parameters




+ ` $cmd `
+ ` $key `
+ ` array $keys `
+ ` array $weights = NULL `
+ ` $op = '' `
<!-- HHAPIDOC -->
