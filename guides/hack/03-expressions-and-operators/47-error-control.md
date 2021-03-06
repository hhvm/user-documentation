The operator `@` suppresses any error messages generated by the evaluation of the expression that follows it.  For example:

```Hack
$infile = @fopen("NoSuchFile.txt", 'r');
```

On open failure, the value returned by `fopen` is `false`, which you can use to handle the error. There is no need to
have any error message displayed.

If a custom error-handler has been established using the library function
[`set_error_handler`](https://www.php.net/manual/en/function.set-error-handler.php) that handler is still called.

This syntax can be disabled with the `disallow_silence` option in `.hhconfig`.
