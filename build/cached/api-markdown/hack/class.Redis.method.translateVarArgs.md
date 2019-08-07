``` yamlmeta
{
    "name": "translateVarArgs",
    "sources": [
        "api-sources/hhvm/hphp/system/php/redis/Redis.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_redis.hhi"
    ],
    "class": "Redis"
}
```




Process arguments for variadic functions based on $flags




``` Hack
protected function translateVarArgs(
  array $args,
  $flags,
);
```




Redis::VAR_TIMEOUT indicates that the last argument
in the list should be treated as an integer timeout
for the operation
Redis::VAR_KEY_* indicates which (NONE, FIRST, NOT_FIRST, ALL)
of the arguments (excluding TIMEOUT, as application)
should be treated as keys, and thus prefixed with Redis::$prefix
Redis::VAR_SERIALIZE indicates that all non-timeout/non-key
fields are data values, and should be serialzed
(if a serialzied is specified)




## Parameters




+ ` array $args `
+ ` $flags `
<!-- HHAPIDOC -->
