```yamlmeta
{
  "min-versions": {
    "HHVM": "3.24"
  },
  "experimental": true
}
```

Async disposables implement `IAsyncDisposable` instead of `IDisposable`:

```Hack
/**
  * Objects that implement IAsyncDisposable may be used in await using statements
  */
interface IAsyncDisposable {
  /**
   * This method is invoked exactly once at the end of the scope of the
   * await using statement, unless the program terminates with a fatal error.
   */
  public function __disposeAsync(): Awaitable<void>;
}
```

For example:

@@ async-disposables-examples/simple.php @@

Async disposables can also be combined with async factory functions:

@@ async-disposables-examples/async-factory.php.type-errors @@
