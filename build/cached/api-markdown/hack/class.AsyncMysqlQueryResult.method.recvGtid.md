``` yamlmeta
{
    "name": "recvGtid",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlQueryResult"
}
```




The GTID of database returned for the current commit




``` Hack
public function recvGtid(): string;
```




This is particularly useful for ` INSERT `, `` DELETE ``, ``` UPDATE ``` statements.




## Returns




+ ` string ` - The gtid of the current commit as a `` string ``.
<!-- HHAPIDOC -->
