# Advanced Typing Rules

The type checking rules are generally straightforward (e.g. can't pass a `string` in something that expects an `int`). There are, however, some rules that have a bit more advanced semantics.

## Soft Type Hints

Take a look at this example.

@@ advanced-rules-examples/softhint.php.type-errors @@

What does the "@" in front of the type mean? This causes HHVM to trigger a warning (thus always continuing execution) instead of a catchable fatal error when the passed parameter does not match. It is used to allow you to slowly add types to your code.

**NOTE**: Soft type hints have *no affect* on the typechecker behavior. The typechecker will still throw an error if a type is mismatched.

## Superglobals

[Superglobals](http://php.net/manual/en/language.variables.superglobals.php) are available no matter what scope you are currently in. 

@@ advanced-rules-examples/superglobals.php @@

The typechecker knows about the built-in superglobals.

**NOTE**: In Hack's [strict mode](../typechecker/modes.md#strict-mode), superglobals are not supported. So you will have to create functions in something like [partial mode](../typechecker/modes.md#partial-mode) to call from a strict mode file.

## Variadic Arguments

Hack supports [variadic arguments](http://php.net/manual/en/migration56.new-features.php). It supports two ways to declare them:

```
function foo(...) // use func_get_args() to get the arguments
function foo(int ...$args) // $args is a list of int arguments
```

The second method is preferred since it is more expressive with the typehint. However, and **this is important**, HHVM does not support variadic parameters *with typehints*

So, use the second method, but you will have to leave off the typehint and have your code in [partial mode](../typechecker/modes.md#partial-mode) or use `HH_FIXME` or `UNSAFE` in [strict mode](../typechecker/modes.md#strict-mode) in order to make both the
typechecker and HHVM happy.

@@ advanced-rules-examples/variadic.php @@

## Fallthrough

Unintentional fallthrough in `switch` statements are a common mistake. Hack provides a way to catch fallthrough, adding a way to tell it that it was intentional as well.

@@ advanced-rules-examples/fallthrough.php @@

Use `// FALLTHROUGH` to tell the typechecker that our falling through is intentional.

## Class Property Initialization

Hack requires class properties to be initialized to a value of its proper annotated type before it is used.

- All non-nullable *static* class properties must be initialized with a value.
- Nullable *static* class properties that don't have an initial value has a `null` value by default.
- All non-nullable *non-static* class properties must be initialized in a constructor.
- Nullable *non-static* class properties that are not initialized in a constructor will have a `null` value by default.
- You cannot call *public* or *private* instance methods on a class before its properties are initialized in the constructor.
- You can call *private* instance methods before properties are initialized in the constructor, as long as the properties are initialized somewhere along that private call chain before a property is accessed.

# Method Inheritance

A parent class defines a method and its children override it. That's very common. Hack has some rules regarding the way overridden methods are typed that must be followed.

- The parameters of any overridden method must match in both argument count and the type on each argument, exactly. 
- A return type of an overridden method may have a more specific type than its parent; they must be compatible, of course (e.g., `arraykey` in the parent; `string` in the child).
