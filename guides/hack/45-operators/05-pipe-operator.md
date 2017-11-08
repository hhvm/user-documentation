The Pipe operator allows for a more concise, fluid syntax for chaining together expressions. It looks like this:

```
f() |> g($$) |> h(5, $$)
```

which conceptually means:

```
h(5, g(f()))
```

That is, evaluate the left hand side (LHS) of the pipe, then evaluate the RHS
of the pipe with the result of the LHS bound to the placeholder `$$`.

Runtime execution is explicitly left-to-right - a pipe's LHS is always executed
before its RHS. More precisely, the LHS of a Pipe is evaluated and its result
stored in a temporary, hidden variable. Then the RHS is evaluated where `$$`
refers to that hidden variable. This means you can use $$ more than once in
the RHS but the LHS will still be evaluated only once. For example:

```
f() |> g1($$) + g2($$) |> h(5, $$)
```

roughly means:

```
h(5, g1(f()) + g2(f()))
```

except that `f()`:
- is evaluated only once
- is evaluated before both `g1` and `g2`.

Hack will enforce that you do use the `$$` of each pipe at least once (if you
didn't, it's probably a bug or you don't need the pipe anyway).

## Examples

Classic:

@@ pipe-operator-examples/map_filter_count.php @@

With Pipe:

@@ pipe-operator-examples/map_filter_count_piped.php @@
