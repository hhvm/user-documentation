In most cases, functions should use their return value to pass information back
to their callers. If more than one piece of information needs to be passed back,
a function could return a tuple, shape or an object.

However, for cases where this is impossible or undesirable, Hack provides a
feature called **inout parameters**.

@@ inout-parameters-examples/basic.hack @@

An inout parameter has *copy-in copy-out* semantics. Roughly, this means:

- The value of an inout argument is copied into the function when it is called.
- The function may mutate the copy arbitrarily.
- When the function returns, the value of the copy is assigned back to the
  argument.

If the function call terminates abnormally, for instance it throws an exception,
changes to the copy are not copied out, and will not be visible even if control
flow resumes inside the caller's scope.

# Restrictions

- Both the call site and the definition must explicitly use `inout` to agree on
  whether an argument will be passed with these semantics. It is both a
  typechecker and runtime error if a function expects an inout parameter but the
  programmer fails to annotate the argument as inout, or vice versa.
- An inout argument must be a *modifiable lvalue*, e.g. variables and other
  expressions that can appear on the left-hand side of an assignment expression
  in Hack. If the expression produces side effects, those effects are observed
  only once. If the lvalue's type cannot change (e.g. it is a class property or
  a variable whose lifetime extends beyond the enclosing scope), then that type
  must be the same as the type of the corresponding inout parameter. Otherwise,
  the lvalue's type may initially be a subtype of the parameter's type.
- The same lvalue cannot be used for multiple inout arguments in the same
  function call (more generally, the lvalue cannot appear more than once in any
  lvalue context within the full expression, including other function calls or
  assignments). This is a type error if the typechecker can statically prove
  that the lvalues are equivalent, otherwise the behavior is undefined.
- An inout parameter cannot have a default value.
- Variadic parameters cannot be inout.
- Methods with special semantics, such as constructors, cannot have inout
  parameters.
- Async functions and generators cannot have inout parameters.
- Methods with inout parameters cannot be memoized using `<<__Memoize>>`.
- It is impossible to call functions with inout parameters dynamically (e.g.
  using `meth_caller()`, `call_user_func()` or `ReflectionFunction::invoke()`).
- If the `unset` intrinsic is invoked on an inout parameter, and the variable is
  not re-initialized before the function exits normally, a warning will be
  raised upon return to the caller and the passed-in argument will be implicitly
  assigned the `null` value.
- Inout annotations on a parameter within a class hierarchy must be
  consistent. Any derived class that overrides that method must declare the same
  (invariant) type for its corresponding parameter -- unlike non-inout
  parameters, a supertype is not allowed (i.e., inout parameters are not
  contravariant).
- A function cannot take both inout parameters and parameters by reference (see
  below). In particular, a parameter cannot be annotated with `inout` and `&`
  simultaneously.

# References (deprecated)

In the past, similar behavior was achieved using *references*
(`int &$parameter`). These are still supported by Hack, but their use is
deprecated and they will be completely removed from the language in the future.
They are not allowed in Hack strict mode.

References enable access to the same variable content by different names. They
bypass the copy-on-write nature of value types such as arrays and allow for
modification of memory normally inaccessible from the current scope.

References are a source of surprising runtime behaviors (especially when
combined with Hack-specific features like async functions or `<<__Memoize>>`)
and type unsoundness in the Hack language (Hack's type inference is designed not
to cross function boundaries, but references can allow access to the same memory
location from multiple functions).

## Migrating to inout parameters

In many cases, references can be completely replaced with patterns that are
easier to understand -- for example, a function could return a tuple, shape or
object instead of assigning values to variables passed in by reference. But when
this is not possible, they should be migrated to inout parameters.

To make the migration easier, HHVM currently allows reference
(`int &$parameter`) and inout (`inout int $parameter`) parameters to be used
interchangeably -- either one can be used, no matter if the function is declared
to take a reference or inout argument.

In most cases, you can migrate by simply replacing `&` with `inout` in all
function declarations and calls. Due to the aforementioned interchangeability,
it is not necessary to migrate a function's declaration and all its calls at the
same time.

In some cases, a straightforward migration is impossible because of the stricter
restrictions on inout parameters (see above), so it might be necessary to change
the function's signature. For example, an optional reference parameter
(`int &$answer = 42`) may need to be removed or made required.

For instance, the builtin function `preg_match()` was migrated to two functions,
`preg_match()` and `preg_match_with_matches()`, which have a previously optional
reference parameter removed and made required, respectively.

```Hack
function preg_match(
  string $pattern,
  string $subject,
  int $flags = 0,
  int $offset = 0,
): int;

function preg_match_with_matches(
  string $pattern,
  string $subject,
  inout mixed $matches,
  int $flags = 0,
  int $offset = 0,
): int;
```
