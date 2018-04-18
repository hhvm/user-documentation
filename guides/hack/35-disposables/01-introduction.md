```yamlmeta
{
  "min-versions": {
    "HHVM": "3.24"
  }
}
```

`using` blocks and and disposables provide an alternative to destructors, executing code on scope exit without requiring reference counting.

This is done by implementing `IDisposable`:

```Hack
/**
  * Objects that implement IDisposable must be constructed in using statements
  */
interface IDisposable {
  /**
   * This method is invoked exactly once at the end of the scope of the
   * using statement, unless the program terminates with a fatal error.
   */
  public function __dispose(): void;
}
```

Disposables can then be used in `using` blocks:

@@ introduction-examples/simple.php @@

In order to ensure that the lifetime of the disposable object can be statically enforced, we need to add a few restriction:
- A local assigned inside the using(...) parentheses can be used only as the target of a method invocation in the using block, or passed to a function or method whose argument is marked with the `<<__AcceptDisposable>>` attribute.
- The same restriction applies to any parameter marked with `<<__AcceptDisposable>>` throughout the function that defined the parameter. This lets you pull code out of the using block into a helper.
- It is not permitted to write a type hint on function parameters that implement `IDisposable` or `IAsyncDisposable`, unless the parameter is marked `<<__AcceptDisposable>>`.
- Classes that implement `IDisposable` or `IAsyncDisposable` may not be constructed in any other context, except when returned by a function marked as `<<__ReturnDisposable>>`.
- functions may not return `IDisposable`, `IAsyncDisposable`, `Awaitable<IDisposable>`, `Awaitable<IAsyncDisposable>`, or subtypes of them unless they are marked as `<<__ReturnDisposable>>`.

## Guidelines

- `<<__AcceptDisposable>>` functions must not store the parameter, or pass it to anything else that is not marked `<<__AcceptDisposable>>`. One use-case is for logging and debugging functions.
- `<<__ReturnDisposable>>` is intended for factory functions.
