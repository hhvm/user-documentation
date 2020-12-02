Why is the `async` keyword needed for functions that return `Awaitable`? Because it is possible to have non-async functions that
return awaitables; the `async` keyword is merely an implementation detail. For this reason, `async` is not allowed in interfaces. For example:

```car.interface.inc.php no-auto-output
interface Car {
  // It doesn't matter to the caller how this is implemented, only that it
  // returns an Awaitable<void>
  public function drive(): Awaitable<void>;
}
```

This can be implemented with an async function, like this:

```car.async-impl.php no-auto-output
class Ford implements Car {
  public async function drive(): Awaitable<void> {
    // ...
  }
}
```

It can also be implemented by a non-async function, like this:

```car.non-async-impl.php no-auto-output
class VolkswagenDiesel implements Car {
  public function drive(): Awaitable<void> {
    // ...
    return $this->driveNormally();
  }
  private async function driveNormally(): Awaitable<void> {
    // ...
  }
}
```

The use of `async` is strongly encouraged for all functions, except for:
- Interface method declarations
- Abstract method declarations

The `async` keyword should be used in most other cases, including implementations of interface or abstract methods.

