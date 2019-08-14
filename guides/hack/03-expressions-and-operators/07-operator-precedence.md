Each of Hack's operators has a given precedence and associativity, as shown in the following table:

Operator | Associativity
------------ | ---------
`new`  | none
`()   []   ->   ?->   ++   --   **` | Left to Right
`instanceof   is   as   ?as` | none
`!   ~   +   -   ++   --   (`*type*`)   @   await`	| Right to Left
`*   /   %`	| Left to Right
`+   -   .`	| Left to Right
`<<   >>`	| Left to Right
`<   <=   >   >=`	| Left to Right
`==   !=   ===   !==   <=>`	| Left to Right
`&`	| Left to Right
`^`	| Left to Right
`\|`	| Left to Right
`&&`    | Left to Right
`\|\|`    | Left to Right
`?:   ??`	| Right to Left
`\|>`	| Left to Right
Lambdas     | Right to Left
`=   +=   -=   .=   *=   /=   %=   <<=   >>=   &=   ^=   \|=` `??=`	| Right to Left
`yield`	| none

The rows of operators in the table are shown in decreasing order of precedence, from top to bottom.  The ordering of operators in any
given table row is arbitrary.  Associativity applies to the order in which operators exist in a given expression, not in a row of the precedence table.

Postfix versions of `++` and `--` have higher precedence than their prefix counterparts.

Precedence is used by the compiler to construct an expression tree and has nothing whatsoever to do with order of evaluation.  It
is a very common mistake to say, *order of evaluation*, when we really mean *precedence*. The two are unrelated in Hack.
