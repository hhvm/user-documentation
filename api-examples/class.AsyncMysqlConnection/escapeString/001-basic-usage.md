The following example shows you how to use `AsyncMysqlConnection::escapeString`
in order to make sure any string pass to something like
`AsyncMysqlConnection::query` is safe for a database query. This is similar to
[`mysql_real_escape_string`](http://php.net/manual/en/function.mysql-real-escape-string.php).

We *strongly* recommend using an API like `AsyncMysqlConnection::queryf` instead,
which automatically escapes strings passed to `%s` placeholders.
