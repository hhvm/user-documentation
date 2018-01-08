```yamlmeta
{
  "min-versions": {
    "HHVM": "3.24"
  }
}
```

In general, disposables should not be returned, and trying to do so is a typechecker error:

@@ factory-functions-examples/type-error.php.type-errors @@

*Output*

```
type-error.php:11:10,21: 'new' must not be used for disposable objects except in a 'using' statement (Typing[4187])
``` 

In some cases - factory functions in particular - returning a disposable is appropriate. In these cases, the function needs to be marked as `<<__ReturnDisposable>>`:

@@ factory-functions-examples/simple.php.type-errors @@

Async factory functions are also supported via `using await`:

@@ factory-functions-examples/async.php.type-errors @@
