AsyncMysqlResult is abstract. See specific, concrete classes for examples of `AsyncMysqlResult::clientStats` (e.g., AsyncMysqlConnectResult, AsyncMysqlErrorResult)

```basic-usage.php
echo "AsyncMysqlResult is abstract. See specific, concrete classes for ".
  "examples of clientStats (e.g., AsyncMysqlConnectResult, ".
  "AsyncMysqlErrorResult)".
  \PHP_EOL;
```.hhvm.expectf
AsyncMysqlResult is abstract. See specific, concrete classes for examples of clientStats (e.g., AsyncMysqlConnectResult, AsyncMysqlErrorResult)
```.example.hhvm.out
AsyncMysqlResult is abstract. See specific, concrete classes for examples of clientStats (e.g., AsyncMysqlConnectResult, AsyncMysqlErrorResult)
```.skipif
<?hh

<<__EntryPoint>>
async function basic_usage_php_skipif_main(): Awaitable<void> {
  \init_docs_autoloader();
  await Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
}
```
