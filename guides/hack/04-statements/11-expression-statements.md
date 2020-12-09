An *expression statement* is simply *any* expression followed by a semicolon (`;`).  The expression is evaluated for its side-effects *only*;
any resulting value is discarded.  For example:

```useful.hack no-auto-output
function do_it(): int {
  return 100;
}

function f(): void {
  $i = 10; // $i is assigned the value 10; the result (10) is discarded
  ++$i; // $i is incremented; result (11) is discarded
  $i++; // $i is incremented; result (10) is discarded
  do_it(); // function do_it is called; result (return value) is discarded
}
```

While the following expression statements are syntactically correct, they serve no useful purpose:

```useless.hack no-auto-output
function f(int $i): void {
  $i;
  -$i;
  123 << $i;
  34.5 * 12.6 + 11.987;
  \sqrt(1.23);
  !true;
}
```

In all cases, there are no side-effects, and the result is discarded.

If an expression statement contains no expression (that is, it's just a semicolon), we have a *null statement*.  Consider the following:

```Hack
while ((c = getNextCharacter()) === " " || c === "\t")
  ;
```

Here we skip all leading spaces and horizontal tabs, and since we do all the work in evaluating the controlling expression, we have nothing
left to do in the loop body. However, syntactically, a loop *must* have a body, so we give it one, a do-nothing null statement.  Be sure to
indent the semicolon to where the body would ordinarily go to make it obvious. The worst thing would be to put the semicolon at the end of
the previous line where that meaning likely would be lost to the reader.

Note, however, we can write this construct without using a null statement, by using an empty block, as follows:

```Hack
while ((c = getNextCharacter()) === " " || c === "\t") {
}
```
