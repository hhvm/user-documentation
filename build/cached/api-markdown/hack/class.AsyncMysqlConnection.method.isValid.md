``` yamlmeta
{
    "name": "isValid",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlConnection"
}
```




Checks if the data inside ` AsyncMysqlConnection ` object is valid




``` Hack
public function isValid(): bool;
```




For
example, during a timeout in a query, the MySQL connection gets closed.




## Returns




+ ` bool ` - `` true `` if MySQL resource is valid and can be accessed;
  ``` false ``` otherwise.
<!-- HHAPIDOC -->
