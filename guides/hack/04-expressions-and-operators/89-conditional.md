The ternary operator `?:` takes three operands.  Based on the value of the first operand, either the second or third operand---but *not* 
both---is evaluated, and their result becomes the result of the whole expression.  For example:

```Hack
$daysInFeb = is_leap_year($year) ? 29 : 28
```

Here, `$daysInFeb` takes on the value 29 or 28, depending on the truth of the result from the call to function `is_leap_year`.  Here's 
another example:

```Hack
for ($i = -5; $i <= 5; ++$i) {
  echo "$i is ". ((($i & 1) === true) ? "odd" : "even") . "\n";
}
```

If the low-order bit of an integer is set, the value is odd; otherwise, it's even. So, the first operand, `($i & 1 === true)`, is 
evaluated. If it is `true`, `"odd"` becomes the result; otherwise, `"even"` becomes the result.

There is a sequence point after the evaluation of the first operand, so any side-effects in that expression are completed before the 
second or third operand is evaluated.  For example:

```Hack
$i++ ? f($i) : g($i * 2); // the sequence point makes this well-defined
```

If the second operand is omitted, the result and type of the whole expression is the value and type of the first expression when it was 
tested.  For example:

```Hack
$a = 10 ?: "Hello";  // result is int with value 10
$a = 0 ?: "Hello";   // result is string with value "Hello"
```

Consider the following:

```Hack
process($a > $b ? 10 : 20, $x !== $y ? f($x) : g($y));
```

Writing this function call *without* using the conditional operator requires a series of nested `if` statements, and if there are more 
conditionally determined arguments, it would be even more unwieldy!  That said, sometimes it might be more overt to use the nested-if 
approach.  Compare the following, alternative approaches:

```Hack
function factorial1(int $int): int
{
  return ($int > 1) ? $int * factorial1($int - 1) : $int;
}

function factorial2(int $i): int {
  if ($i > 1) return $i * factorial2($i - 1);
  else if ($i === 1) return $i;
  else return 0;
}
```
