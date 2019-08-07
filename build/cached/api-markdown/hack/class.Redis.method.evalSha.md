``` yamlmeta
{
    "name": "evalSha",
    "sources": [
        "api-sources/hhvm/hphp/system/php/redis/Redis.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_redis.hhi"
    ],
    "class": "Redis"
}
```




``` Hack
public function evalSha(
  $scriptSha,
  array $args = array (
),
  $numKeys = 0,
);
```




## Parameters




+ ` $scriptSha `
+ ` array $args = array ( ) `
+ ` $numKeys = 0 `
<!-- HHAPIDOC -->
