``` yamlmeta
{
    "name": "queryf",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlConnection"
}
```




Execute a query with placeholders and parameters




``` Hack
public function queryf(
  HH\FormatString<HH\SQLFormatter> $pattern,
  ...$args,
): Awaitable<AsyncMysqlQueryResult>;
```




This is probably the more common of the two query methods, given its
flexibility and automatic escaping in most string cases.




For example:
` queryf("SELECT %C FROM %T WHERE %C %=s", $col1, $table, $col2, $value); `




The supported placeholders are:

+ ` %T `   table name
+ ` %C `   column name
+ ` %s `   nullable string (will be escaped)
+ ` %d `   integer
+ ` %f `   float
+ ` %=s `  nullable string comparison - expands to either:
  `` = 'escaped_string' ``
  ``` IS NULL ```
+ ` %=d `  nullable integer comparison
+ ` %=f `  nullable float comparison
+ ` %Q `   raw SQL query. The typechecker intentionally does not recognize
  this, however, you can use it in combination with // UNSAFE
  if absolutely required. Use this at your own risk as it could
  open you up for SQL injection.
+ ` %Lx `  where `` x `` is one of ``` T ```, ```` C ````, ````` s `````, `````` d ``````, or ``````` f ```````, represents a list
  of table names, column names, nullable strings, integers or
  floats, respectively. Pass a ```````` Vector ```````` of values to have it
  expanded into a comma-separated list. Parentheses are not
  added automatically around the placeholder in the query string,
  so be sure to add them if necessary.




With the exception of ` %Q `, any strings provided will be properly
escaped.




## Parameters




* ` HH\FormatString<HH\SQLFormatter> $pattern ` - The query string with any placeholders.
* ` ...$args ` - The real values for all of the placeholders in your query
  string. You must have as many values as you do
  placeholders.




## Returns




- ` Awaitable<AsyncMysqlQueryResult> ` - an `` Awaitable `` representing the result of your query. Use
  ``` await ``` or ```` join ```` to get the actual ````` AsyncMysqlQueryResult `````
  object.




## Examples




The following example shows how to use ` AsyncMysqlConnection::queryf `. First you get a connection from an `` AsyncMysqlConnectionPool ``; then you decide what parameters you want to pass as query placeholders.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlConnection/queryf/001-basic-usage.php @@




The following example uses the ` %=s ` placeholder in order to allow you to check whether an email address with the provided `` string `` exists in the table, or, if ``` null ``` is passed, whether there is a user with a ```` null ```` email address.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlConnection/queryf/002-percent-equal-placeholders.php @@




The following example shows how to use the ` %L ` placeholder for `` AsyncMysqlConnection::queryf ``. First you get a connection from an ``` AsyncMysqlConnectionPool ```; then we are passing a vector of ids to used in the placeholder. The placeholder ends up being ```` %Ld ```` since the ids are integers.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlConnection/queryf/003-percent-L-placeholders.php @@
<!-- HHAPIDOC -->
