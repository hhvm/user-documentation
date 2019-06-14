A `break` statement can be used to interrupt the iteration of a loop statement and to break-out to the statement immediately following
that loop statement.  For example:

```Hack
while (true) {
  ...
  if ($done)
    break;  // break out of the while loop
  ...
}
```

Sometimes it is useful to have an infinite loop from which we can escape when the right condition occurs.

Although a `break` statement must not attempt to break out of a finally block, a `break` statement can break out of a construct that is
fully contained within a finally block.

A `break` statement can also affect a non-looping context; it terminates a case in a `switch` statement.
