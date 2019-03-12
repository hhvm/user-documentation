The unary minus operator, `-`, requires an operand of arithmetic type.  The value of the result is the negated value of the operand.

Note carefully, that in environments supporting twos-complement integer representation, if `$v` contains the smallest negative value,
then `-$v` results in the *exact same* smallest negative value, because there is *no* negated equivalent.
