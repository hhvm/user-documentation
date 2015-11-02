The following example shows how to use `AsyncMysqlConneciton::queryf`. First you get a connection from an `AsyncMysqlConnectionPool`; then you decide what parameters you want to pass as query placeholders. Supported placeholders are:

*   `%T`   table name
*   `%C`   column name
*   `%s`   nullable string (will be escaped)
*   `%d`   integer
*   `%f`   float
*   `%=s`  nullable string comparison - expands to either:
    *          `= 'escaped_string'`
    *          `IS NULL`
*   `%=d`  nullable integer comparison
*   `%=f`  nullable float comparison
*   `%Q`   raw SQL query. The typechecker intentionally does not recognize
*          this, however, you can use it in combination with `// UNSAFE`
*          if absolutely required 
