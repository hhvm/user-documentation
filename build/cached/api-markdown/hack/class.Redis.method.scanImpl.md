``` yamlmeta
{
    "name": "scanImpl",
    "sources": [
        "api-sources/hhvm/hphp/system/php/redis/Redis.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_redis.hhi"
    ],
    "class": "Redis"
}
```




``` Hack
protected function scanImpl(
  $cmd,
  $key,
  &$cursor,
  $pattern,
  $count,
);
```




## Parameters




+ ` $cmd `
+ ` $key `
+ ` &$cursor `
+ ` $pattern `
+ ` $count `
<!-- HHAPIDOC -->
