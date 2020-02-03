An *expression* involves one or more terms and zero or more operators.  Consider the following:

```Hack
$result = get_value(123, "Monday", true);
```

This is an expression, which contains other (sub)expressions: the source code elements `$result`, `getvalue`, `123`, `"Monday"`,
and `true`; the operators assignment `=` and function-call `()`; and the subexpression `get_value(123, "Monday", true)`.

A *side-effect* is an action that changes the state of the execution environment. (Examples of such actions are modifying a variable,
writing to a file, or calling a function that performs such operations.)

When an expression is evaluated, it produces a result. It might also
produce a side-effect. The occurrence of value computation and side-effects is delimited by *sequence points*, places in a program's execution at which all
the computations and side-effects previously promised are complete, and no computations or side-effects of future operations have yet
begun.

There is a sequence point at the end of each full expression. The [logical AND](logical-AND.md), [logical OR](logical-inclusive-OR.md),
[ternary](ternary.md), and [function-call](function-call.md) operators each contain a sequence point. For example, in the following
series of statements:

```Hack
$a = 10; ++$a; $b = $a;
```

there is sequence point at the end of each full expression, so the assignment to $a is completed before `$a` is incremented, and the
increment is completed before the assignment to `$b`.

## Precedence and Associativity

When an expression contains multiple operators, the *precedence* of those operators controls the order in which those operators are
applied. For example, the expression

```Hack
$a - $b / $c
```

is evaluated as:

```Hack
$a - ($b / $c)
```

because the division (`/`) operator has higher precedence than the binary subtraction `-` operator.  The precedence of all operators is
defined in [operator precedence](operator-precedence.md).

If an operand occurs between two operators having the same precedence, the order in which the operations are performed is defined by those
operators' *associativity*. With *left-associative* operators, operations are performed left-to-right.  For example:

```Hack
$a + $b - $c`
```

is evaluated as:

```Hack
($a + $b) - $c
```

With *right-associative* operators, operations are performed right-to-left.

Precedence and associativity can be controlled using *grouping parentheses*. For example, in the following expression:

```Hack
($a - $b) / $c
```

The subtraction is done before the division. Without the grouping
parentheses, the division would take place first.

While precedence, associativity, and grouping parentheses control the
order in which operators are applied, they do not control the order of
evaluation of the terms themselves. Unless stated otherwise, the order
in which the operands in an expression are evaluated relative to each
other is unspecified.
