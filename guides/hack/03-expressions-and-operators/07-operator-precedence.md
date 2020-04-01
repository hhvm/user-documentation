The precedence of Hack operators is shown in the table below.

Operators higher in the table have a higher precedence (binding more
tightly). Binary operators on the same row are evaluated according to their
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
`\|>` | Left
`=` `+=` `-=` `.=` `*=` `/=` `%=` `<<=` `>>=` `&=` `^=` `\|=` `??=` | Right
`print` | Right
`include` `require` | Left
