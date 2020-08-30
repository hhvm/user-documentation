The type `nothing` is the bottom type in the Hack typesystem. This means that there is no way to create a value of the type `nothing`. `nothing` only exists in the typesystem, not in the runtime.

The concept of a bottom type is quite difficult to grasp, so I'll first compare it to the supertype of everything `mixed`. `mixed` is the most general thing you can imagine within the hack typesystem. Everything "extends" `mixed` if you will. `nothing` is the exact opposite of that.

Let's work out the hierarchy of scalar types. Forget about nullable types and `dynamic` for the moment, they would make this example far more complex without adding much value.

 - `mixed` is at the top. Everything is a subtype of `mixed`, either directly (types that have no other supertypes) or indirectly (via their supertypes).
 - `num` is a subtype of `mixed`.
 - `arraykey` is a subtype of `mixed`.
 - `bool` is a subtype of `mixed`.
 - `int` is a subtype of `num` and `arraykey`.
 - `float` is a subtype of `num`.
 - `string` is a subtype of `arraykey`.
 - `nothing` is a subtype of `int`, `float`, `string`, and `bool`.

The important thing to note here is that `nothing` is never between two types. `nothing` only shows up right below a type with no other subtypes.

## Usages

When defining a function that will never return (it either throws, loops forever, or terminates the request) you can use `nothing` for the return type. This gives more information to the caller than `void` and is more flexible than [noreturn](./noreturn). `nothing` can be used in expressions (like `nullable T ?? nothing`) and it will typecheck "as if it wasn't there", since `(T & nothing)` is _just_ `T`.

`nothing` can be used to create a `throw` expression in this way. 

@@ nothing-examples/throw-as-an-expression.php @@

<hr>

When writing a new bit of functionality, you may write an interface which does not have any classes implementing it yet. When trying to get some work done, you may find yourself wanting to call a method which requires such an interface in its arguments. You now have a choice. You can either ignore the typeerror and continue working on the thing you were trying to do. Or you stop doing what you were doing and write a class that implements this interface to satisfy the typehint. Both are not ideal. The first option keeps a typeerror, which may be distracting for you. The second option completely breaks your flow state and when you come back, you will be less effective while you're getting back into your flow.

`nothing` is an amazing solution which allows you to keep working what you were working on, without having the nagging feeling of the typeerror that needs to be fixed. The trick is defining a function with the return type of `nothing`. This function may not return anything (just like a `noreturn` function). You can now use this function as a placeholder for the value which you could not create. I have called this function (and an opaque type alias) `undefined`, as an homage to Haskell [undefined](https://wiki.haskell.org/Undefined).

@@ nothing-examples/undefined.php @@

And here is how to use it

@@ nothing-examples/using-undefined.php @@

You could make your staging environment remove the file which declared the `undefined()` function. That way you'll get a typechecker error when you accidentally push code that has these placeholders in it. This prevents you from accidentally deploying unfinished code to production.

<hr>

When making a new / empty `Container<T>`, Hack will infer its type to be `Container<nothing>`. It is not that there are actual value of type `nothing` in the `Container<T>`, it is just that this is a very nice way of modeling empty `Container<T>`s.

Should you be able to pass an empty vec where a `vec<string>` is expected? Yes, there is no element inside that is not a `string`, so that should be fine. You can even pass the same vec into a function that takes a `vec<bool>` since there are no elements that are not of type `bool`. What are you allowed to do with the `$nothing` of this foreach? Well, you can do anything to it. Since nothing is a subtype of everything, you can pass it to any method and do all the things you want to.

@@ nothing-examples/empty-vec.php @@

<hr>

To make an interface that requires that you implement a method, without saying anything about its types. This does still make a requirement about the amount of parameters that are required parameters.

@@ nothing-examples/very-wide-interface.php @@

It is important to note that `Software::shipIt()` is not directly callable without knowing what subtype of `Software` you have.
