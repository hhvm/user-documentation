The type checking rules are generally straightforward (e.g. can't pass a `string` in something that expects an `int`). There are, however, some rules that have a bit more advanced semantics.

# Soft Type Hints

What does an "@" in front of a Hack type mean?

This causes the typehint to log an error and continue instead of throwing an exception when the passed parameter does not match. It is used to allow you to slowly add types to a codebase via a script or some automated fashion (manual is ok too). Then, automated scripts can look for mismatched types in the error logs and remove them, and then remove the "@" from types that never mismatch.

# Superglobals

# Variadic Arguments

# Fallthrough

# Property Initialization

# Method Inheritance

