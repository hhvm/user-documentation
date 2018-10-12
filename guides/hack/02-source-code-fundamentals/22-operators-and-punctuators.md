Operators are symbols used in expressions to describe operations involving one or more operands, and that yield a resulting 
value, produce a side-effect, or some combination thereof.  For example:

```Hack
$retailPrice = $costPrice + $markup // = and + operators
$count++                            // side-effect postfix ++
$j = ++$i                           // = and side-effect prefix ++
\sqrt(12.34)                        // function-call operator ()
```

Punctuators are symbols used for grouping and separating. For example:

```Hack
function move(float $x, float $y): void { ... }
```

where `(`, `,`, `)`, `:`, `{`, and `}` are punctuators.

An operator or punctuator involving more than one character must be written *without* any embedded white space. For 
example, `++` and `+ +` are *not* equivalent!  

The complete set of operator and punctuators is:

```Hack
[   ]    (   )   {    }   .   ->   ++   --   **   *   +   -   ~   !
$   /   %   <<   >>   <   >   <=   >=   ==   ===   !=   !==   ^   |
&   &&  ||   ?   ??   :   ; =   **=   *=   /=   %=   +=   -=   .=   <<=
>>=   &=   ^=   |=   ,   @   ::   =>   ==>   ?->   \   ...    |>   $$
```
