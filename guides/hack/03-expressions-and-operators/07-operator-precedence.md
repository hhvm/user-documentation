Each operator in Hack has a precedence and associativity. This table
shows precedence (highest precedence first), and the relevant
associativity.

Operator | Associativity
------------ | ---------
`\` | Left
`[]` | Left
`->` `?->` | Left
`new`  | None
`()` | Left
`clone` | None
`await` `++` `--` (postfix) | Right
`(int)` `(float)` `(string)` `**` `@` `++` `--` (prefix) | Right
`is` `as` `?as` | Left
`!` `~` `+` `-` (one argument) | Right
`*` `/` `%` | Left
`.` `+` `-` (two arguments) | Left
`<<` `>>` | Left
`<` `<=` `>` `>=` `<=>` | None
`===` `!==` `==` `!=` | None
`&&` | Left
`^` | Left
`\|\|` | Left
`&` | Left
`\|` | Left
`??` | Right
`?` `:` `?:` | Left
`|>` | Left
`=` `+=` `-=` `.=` `*=` `/=` `%=` `<<=` `>>=` `&=` `^=` `\|=` `??=` | Right
`print` | Right
`include` `require` | Left

The ordering of operators in any given table row is arbitrary.
Associativity applies to the order in which operators exist in a given
expression, not in a row of the precedence table.
