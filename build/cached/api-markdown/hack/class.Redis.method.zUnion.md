``` yamlmeta
{
    "name": "zUnion",
    "sources": [
        "api-sources/hhvm/hphp/system/php/redis/Redis.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_redis.hhi"
    ],
    "class": "Redis"
}
```




``` Hack
public function zUnion(
  $Output,
  $ZSetKeys,
  array $Weights = array (
),
  $aggregateFunction = 'SUM',
);
```




## Parameters




+ ` $Output `
+ ` $ZSetKeys `
+ ` array $Weights = array ( ) `
+ ` $aggregateFunction = 'SUM' `
<!-- HHAPIDOC -->
