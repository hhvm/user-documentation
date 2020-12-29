A `continue` statement terminates the execution of the innermost enclosing `do`, `for`, `foreach`, or `while` statement.  For example:

```odd-values.hack
for ($i = 1; $i <= 10; ++$i) {
  if (($i % 2) === 0) {
    continue;
  }
  echo "$i is odd\n";
}
```

Although a `continue` statement must not attempt to break out of a finally block, a `continue` statement can terminate a loop that is
fully contained within a finally block.
