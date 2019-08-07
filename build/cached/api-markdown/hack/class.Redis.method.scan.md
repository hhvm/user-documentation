``` yamlmeta
{
    "name": "scan",
    "sources": [
        "api-sources/hhvm/hphp/system/php/redis/Redis.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_redis.hhi"
    ],
    "class": "Redis"
}
```




``` Hack
public function scan(
  &$iterator,
  $pattern = NULL,
  $count = NULL,
);
```




## Parameters




+ ` &$iterator `
+ ` $pattern = NULL `
+ ` $count = NULL `
<!-- HHAPIDOC -->
