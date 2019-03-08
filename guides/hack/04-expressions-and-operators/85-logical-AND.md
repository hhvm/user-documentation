The binary operator `&&` determines the truth of an expression involving two operands. For example:

```Hack
if ($month > 1 && $month <= 12) ...
```

Here, the left-hand operand, `$month > 1`, is evaluated first. If the result is `false`, the right-hand operand, `$month <= 12`, is *not* 
evaluated, and the result has type `bool`, value `false`.  Otherwise, the right-hand operand is evaluated, and if it has the value `false`, 
the result has type `bool`, value `false`; otherwise, the result has type `bool`, value `true`.  

Consider the following:

```Hack
if ($month > 6 && get_value(--$count) < 50) ...
```

Only if `$month` is greater than 6 is `$count` decremented and function `get_value` called. That is, there is a [sequence point](some-basics.md) 
after the evaluation of the left-hand operand. Consider the following:

```Hack
if ($x++ + do_it() < 15 && $values[$x] > 10) ...
```

Because of the sequence point, we know that if the left-hand operand tests `true`, and we're evaluating the right-hand operand, `$x` 
will already have been incremented and function `do_it` will have been called. 

If either operand does not have type `bool`, its value is first converted to that type.
