``` yamlmeta
{
    "name": "mysql_async_wait_actionable",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mysql/ext_mysql-async.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ]
}
```




Block on one or more asynchronous operations, or until the specified timeout
has occurred




``` Hack
function mysql_async_wait_actionable(
  array $items,
  float $timeout,
): mixed;
```




Returns values from the 'items' parameter when they become
actionable. Entries are returned as soon as they are actionable (i.e., it
does not wait for the entire timeout before returning results).




## Parameters




+ ` array $items ` - An array of arrays. These arrays contain a MySQL link
  identifier in the 0'th position, and any other values
  in the remainder of the array. Items from this
  parameter are returned unmodified as the result set
  of actionable entries.
+ ` float $timeout ` - Time, in seconds, to wait for actionable events.
  Subsecond accuracy is supported.




## Returns




* ` mixed ` - - Returns input entries that are now ready for action (such as
  a connection has completed or rows are available).
<!-- HHAPIDOC -->
