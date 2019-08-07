``` yamlmeta
{
    "name": "noIndexUsed",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlQueryResult"
}
```




Returns whether or not any of the queries executed did not use an index
during execution







``` Hack
public function noIndexUsed(): bool;
```




## Returns




+ ` bool ` - 'true' if no index was used for any of the queries executed,
  'false' otherwise
<!-- HHAPIDOC -->
