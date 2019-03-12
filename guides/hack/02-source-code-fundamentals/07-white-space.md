A Hack program is made up of a well-formed series of source *tokens* (such as user-defined names, keywords, operators, punctuators,
and literals). To avoid ambiguity or to make source code more readable, in a source file, *white-space* characters can be placed
before the first token, after the last token, and between any two adjacent tokens. Consider the following code fragments:

```Hack
$value = 100;                // case 1
     $value    =    100   ;  // case 2
$value                       // case 3
=
100
;
$value=100;                  // case 4
```

All four cases are equivalent; they assign 100 to the local variable `$value`. They differ only by the amount and kind of white space
between tokens. And as shown in the final case, technically, no white space is needed at all. That said, you should use white space to
make code more readable. In the following, at least some white space is needed, to ensure the correct token recognition:

```Hack
function compute(int $p1, float $p2): void { /* ... */ }   // case 1
functioncompute(int$p1, float$p2):void {/* ... */}         // case 2
```

The only place white space is needed is between the keyword `function` and the user-defined name `compute`. None is needed between the
type names `int` and `float` and the user-defined names `$p1` and `$p2`, respectively, as the `$` character *cannot* occur in the
middle of a user-defined name. That said, without white space there, the code is harder to read.

White space consists of an arbitrary combination of one or more new-line, space (U+0020), and horizontal tab (U+0009) characters.
A new-line is either a carriage-return character (U+000D), a line-feed character (U+000A), or a carriage-return character (U+000D)
followed immediately by a line-feed character (U+000A).
