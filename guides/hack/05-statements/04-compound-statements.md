A *compound statement* allows a set of zero or more statements to be treated syntactically as a single statement, by enclosing them in
a pair of braces (`{` and `}`).  A compound statement is often referred to as a *block*.

Consider the following:

```Hack
$i = 10;
while ($i > 0)
  echo "\$i = " . $i-- . "\n";
```

which displays the values from 10 down to 1, each on a new line.  We do two things inside the body of the `while`: output the text and
decrement `$i`. We can achieve the same things by breaking the single `echo` statement into two statements, as follows:

```Hack
$i = 10;
while ($i > 0) {
  echo "\$i = " . $i . "\n";
  $i--;
}
```

The body of a `while` (as well as `for`, `foreach`, `do`, and `if` true and false paths, among other contexts) is *required* to be a *single
statement*. So, we must make those two statements a block, as shown. If we do *not* do that, we have the following:

```Hack
$i = 10;
while ($i > 0)  // infinite loop
  echo "\$i = " . $i . "\n";
  $i--;         // never gets executed!
```

which results in an infinite loop, because the single-statement body of the `while` is the `echo` statement, and inside that, the value of `$i`
*never* changes!  Of course, having the decrement statement be indented to 'show visually' that it's part of the `while` body, makes no difference.
The indentation is simply white space, and the compiler ignores that!

It is common to have the bodies of `while` (and other) statements be a single statement, in which case, what should our programming style be
with respect to writing explicit braces? If we adopt the style, 'Use braces only when they are needed', we can get into trouble, because during
development and testing, it is often useful to add a debug/trace statement inside such a body, but if the braces aren't already there, we'd have
to add them (probably on the second attempt, after we found we just introduced an infinite loop on the first try).
