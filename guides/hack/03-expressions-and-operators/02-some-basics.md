An *expression* involves one or more terms and zero or more operators.  Consider the following:

```Hack
$result = get_value(123, "Monday", true)
```

This is an expression, which contains other (sub)expressions: the source code elements `$result`, `getvalue`, `123`, `"Monday"`,
and `true`; the operators assignment `=` and function-call `()`; and the subexpression `get_value(123, "Monday", true)`.

A *full expression* is an expression that is *not* part of another expression.  Consider the following:

```Hack
$result = get_value(123, "Monday", true);
$v = 10 + $result;
++$v;
for ($i = 1; $i <= 10; ++$i) {
  echo "$i\t" . ($i * $i) . "\n"; // output a table of squares
}
return \sqrt($x*$x + $y*$y);
```

The full expressions in this example are, as follows:

```Hack
$result = get_value(123, "Monday", true)
$v = 10 + $result
++$v
$i = 1
$i <= 10
++$i
echo "$i\t".($i * $i)."\n"
\sqrt($x*$x + $y*$y)
```

A *side-effect* is an action that changes the state of the execution environment. (Examples of such actions are modifying a variable,
writing to a device or file, or calling a function that performs such operations.)

When an expression is evaluated, it produces a result. It might also produce a side-effect. The Hack operators that produce side-effects are
assignment, prefix and postfix `++` and `--`, and sometimes function-call `()`.  For example, given the
[expression statement](../statements/expression-statements.md)

```Hack
$v = 10;
```

the expression 10 is evaluated to the result 10, and there is no side-effect. Then the assignment operator is executed, which results in the
side-effect of `$v` being modified. The result of the whole expression is the value of `$v` after the assignment has taken place. However,
that result is *not* used! Similarly, given the expression statement

```Hack
++$v;
```

the expression is evaluated to the result 11, and the side-effect is that `$v` is actually incremented. Again, the final result, 11, is not
used.  [If you are confused by that explanation, consider that the perfectly well-formed expression statement `$v + 6;` has no affect; it
has no side-effect and its result is not used.]

The occurrence of value computation and side-effects is delimited by *sequence points*, places in a program's execution at which all
the computations and side-effects previously promised are complete, and no computations or side-effects of future operations have yet
begun. There is a sequence point at the end of each full expression. The [logical AND](logical-AND.md), [logical OR](logical-inclusive-OR.md),
[conditional](conditional.md), and [function-call](function-call.md) operators each contain a sequence point. (For example, in the following
series of expression statements:

```Hack
$a = 10; ++$a; $b = $a;
```

there is sequence point at the end of each full expression, so the assignment to $a is completed before `$a` is incremented, and the
increment is completed before the assignment to `$b`.

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

With *right-associative* operators, operations are performed right-to-left.  For example:

```Hack
$a = $b = $c
```

is evaluated as:

```Hack
$a = ($b = $c)
```

Precedence and associativity can be controlled using *grouping parentheses*. For example, in the following expression:

```Hack
($a - $b) / $c
```

The subtraction is done before the division. Without the grouping parentheses, the division would take place first.
While precedence, associativity, and grouping parentheses control the order in which operators are applied, they do **not** control
the order of evaluation of the terms themselves! Unless stated otherwise, the order in which the operands in an expression are evaluated
relative to each other is *unspecified*. (See the discussion above about the operators that contain sequence points.)  For example, in
the following full expression:

```Hack
$list1[$i] = $list2[$i++]   // diagnosed by the type checker
```

whether the value of `$i` on the left-hand side is the old or new `$i`, is unspecified. Similarly, in the following full expression:

```Hack
$j = $i + $i++   // diagnosed by the type checker
```

whether the value of `$i` is the old or new `$i`, is unspecified. The same situation occurs in the following:

```Hack
$v = $a + ($a = 6)   // diagnosed by the type checker
```

As shown by the comments, in all three cases, the type checker complains, saying something like "Unsequenced modification and access
to local variable", which is good, as there are *no* sequence points in these full expressions.

Finally, in the following full expression:

```Hack
f() + g() * h()
```

the order in which the three functions are called, is unspecified.  Yes, multiplication takes precedence over addition, but that
says **absolutely nothing** about the order in which the three functions are called!
