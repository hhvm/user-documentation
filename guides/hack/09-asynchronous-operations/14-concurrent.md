`concurrent` blocks are a future feature, expected to launch with HHVM 4.5. `concurrent` blocks are a replacement for the `Tuple\from_async` pattern that makes the behavior of the code much clearer. It concurrently awaits all `await`s within a `concurrent` block and it works with [`await`-as-an-expression](await-as-an-expression.md) as well!

Note: (concurrent doesn't not mean multi-threading](some-basics#limitations)

## Syntax

```
concurrent {
  $x = await x_async();
  await void_async();
  $sum = await y_async() + await z_async()();
}
$y = $x + $sum;
```

## Order-of-execution

Each of the statements in a `concurrent` block should be thought of as running concurrently. This means there shouldn't be any dependencies between the statements in a `concurrent` block.

Similar to `await`-as-an-expression, `concurrent` blocks don't provide a guaranteed order-of-execution between expressions being evaluated for any statement in the `concurrent` block. We guarantee that modifications to locals will happen after all other expressions resolve and will happen in the order in which they would happen outside a `concurrent` block.

For this example, we provide no guarantee on the order `x()`, `y_async()` or `z_async()` will be executed, but the assignments into `$result` are guaranteed to be well ordered.

```
$result = vec[];
concurrent {
  $result[] = x() + await y_async();
  $result[] = await z_async();
}
```
