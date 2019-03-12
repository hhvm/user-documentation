The null-safe member-selection operator, `?->`, is like the [member-selection operator, `->`](member-selection.md), except
that the left-hand operand must be an object with some [nullable type](../types/nullable-types.md).  If the left-hand operand's
value is `null`, no property or method is selected, and the resulting value is `null`. Otherwise, the behavior is like that of `->`.
