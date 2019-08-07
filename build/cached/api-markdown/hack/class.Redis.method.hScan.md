``` yamlmeta
{
    "name": "hScan",
    "sources": [
        "api-sources/hhvm/hphp/system/php/redis/Redis.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_redis.hhi"
    ],
    "class": "Redis"
}
```




``` Hack
public function hScan(
  $key,
  &$iterator,
  $pattern = NULL,
  $count = NULL,
);
```




## Parameters




+ ` $key `
+ ` &$iterator `
+ ` $pattern = NULL `
+ ` $count = NULL `
<!-- HHAPIDOC -->
