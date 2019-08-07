``` yamlmeta
{
    "name": "processArrayCommand",
    "sources": [
        "api-sources/hhvm/hphp/system/php/redis/Redis.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_redis.hhi"
    ],
    "class": "Redis"
}
```




Actually send a command to the server




``` Hack
protected function processArrayCommand(
  $cmd,
  array $args,
);
```




assumes all appropriate prefixing and serialization
has been preformed by the caller and constructs
a Redis Protocol packet in the form:




*N\\r\\n




Folled by N instances of:




$L\\r\\nA




Where L is the length in bytes of argument A.




So for the command ` GET somekey ` we'd serialize as:




"*2\\r\\n$3\\r\\nGET\\r\\n$7\\r\\nsomekey\\r\\n"




## Parameters




+ ` $cmd `
+ ` array $args `
<!-- HHAPIDOC -->
