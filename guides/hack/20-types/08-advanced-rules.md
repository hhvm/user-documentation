The type checking rules are generally straightforward (e.g. can't pass a `string` to something that expects an `int`). There are, however, some rules that have a bit more advanced semantics.

## Soft Type Hints

Take a look at this example.

@@ advanced-rules-examples/softhint.php.type-errors @@

What does the "@" in front of the type mean? This causes HHVM to trigger a warning (thus always continuing execution) instead of a catchable fatal error when the passed parameter does not match. It is used to allow you to slowly add types to your code.

Soft type hints have *no effect* on the typechecker behavior. The typechecker will still throw an error if a type is mismatched.

## Superglobals

[Superglobals](http://php.net/manual/en/language.variables.superglobals.php) are available no matter what scope you are currently in. 

@@ advanced-rules-examples/superglobals.php @@

The typechecker knows about the built-in superglobals.

In Hack's [strict mode](../typechecker/modes.md#strict-mode), superglobals are not supported. So you will have to create functions in something like [partial mode](../typechecker/modes.md#partial-mode) to call from a strict mode file.

A not perfect, but possibly viable, alternative to using superglobals can be accomplished using a [repository](https://github.com/fredemmott/psr7-http-message-hhi) that exposes [PSR-7](https://github.com/php-fig/http-message) to Hack. The HHI files in this repo give the Hack typechecker information about interfaces.

## Variadic Arguments

Hack supports [variadic arguments](http://php.net/manual/en/migration56.new-features.php):

```
function foo(<any explicit arguments>, int ...$args) // $args is a list of int arguments
```

The typechecker will enforce the variadic types, however for performance, the runtime will not.

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
