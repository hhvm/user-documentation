## Why?

1. We'd like to have various rules preventing things we know are unsafe in concurrent blocks. For example, assigning something twice in the middle of two different expressions in a concurrent block. `concurrent { $x1 = await x_async($y = 42); $x2 = await y_async($y = 43); }`
2. Since we will be allowing `await-as-an-expression` outside of concurrent blocks, we'd like to not have to special case these rules so that they only kick in when adding an `await`  to a statement.
3. There is a general belief that due to the current scoping of variables, complex assignment is very hard to reason about when writing Hack code.
4. We considered having more pointed rules that would allow much more complex rules that attempt to enable more possible usages of lval-as-an-expression, but based on initial testing, the level of usage of this feature is already very low, so it doesn't seem useful to support. Having simpler rules is a win in-and-of itself.

## Definitions

`lval` will be banned in non-final positions. These are positions in which if you forced the `lval` to return `void` will still be allowed.

### `lval` positions:

* Assignment:
    * `<lval> <op>= ...`
* Inout arg:
    * `f(inout <lval>)`
* ++/--:
    * `<lval>++`
    * `<lval>--`
    * `++<lval>`
    * `--<lval>`
* foreach:
    * `foreach (... as <lval>) ...`
    * `foreach (... as <lval> => <lval>) ...`
* list:
    * `list(<lval>, ...)`

### “final” `lval`:

* Positions:
    * These are positions which take expressions but do nothing with their result (accept `void`). They promote normal lvals to “final lval”.
    * ExpressionStatement: `<final_lval>;`
    * For: `for (<final_lval>, <final_lval>, ...; ...; <final_lval>, <final_lval>, ...) ...`
    * Using:
        * `using $x = ...;`
        * `using ($x = ..., $y = ...) { ... }`
        * `await using ($x = await ..., $y = await ...) { ... }`
* Assignment:
    * If the assignment is directly in a final lval position
    * `<lval> <op>= ...;`
* Inout arg:
    * If the call is directly in a final lval position
    * `f(inout <lval>);`
    * `Foo::f(inout <lval>);`
    * `$bar->f(inout <lval>);`
    * We also make an exception to allow assigning and inout at the same time.
    * `$x = f(inout <lval>, ...);`
    * Also we allow@'ing the function
    * `$x = @f(inout <lval>, ...);`
* & arg:
    * Same rules as inout except w/ `&`
* ++/--:
    * Must be directly in a final lval position
    * `<lval>++;`
    * `<lval>--;`
    * `++<lval>;`
    * `--<lval>` ;
    * `for ($x++; ...; $y++) { ... }`
* foreach:
    * Always in a final lval position
* list:
    * Must be directly in a lval position that is a final lval
    * `list(<lval>, ...) = $x;`
    * `foreach (... as list(<lval>, ...)) { ... }`
