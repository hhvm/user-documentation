The `nothing` type is the bottom type. It is _not_ impossible to create a **value** of type `nothing`. It is only possible for something that usually holds a value, to be typed as nothing. The typechecker uses this type to model the fact that certain expressions will not ever have a value that can be observed.

In the following example, we create a variable `$number_of_boats` with the type int. We then create a region of code that is unreachable (if false). The typechecker is able to pick up that we will never enter the body of the if. Therefore, the types of all the locals are set to `nothing`.

@@ nothing-examples/if-false.php @@

You might be understandably confused why we were allowed to call a method on something that you assumed to be an int. Any other language with static types would be screaming at you and refusing to compile/run. Hack however, understands that reporting an error on this code will not save you trouble at runtime. This code will never do something to `$number_of_boats` that is not allowed. Therefore, the typechecker will not report an error here.

You should almost never have to annotate your code with `nothing`, since it does not make sense as a class member, function/method parameter or return type. It _can_ sometimes be used in places where a generic is expected. You'll most often encounter this type when creating an empty `Container<T>`.

@@ nothing-examples/empty-container.php @@

There is nothing special about `vec<T>` that other `Container<T>`'s don't have. This example would have worked the same for `dict<Tk, Tv>` and `keyset<T>`.

It is important to realize that `vec<nothing>` _must_ be an empty vec. You can't have a value of type `nothing`, so you are not pulling `nothing`s out of this vec in the foreach. It is just that, the `$person` variable will never hold a value, so giving it a type other than `nothing` would be weird.

In previous versions of hhvm, this concept was instead modeled by using the pseudo type TAny a.k.a. `_`. If you are running hhvm 4.1 or above, ignore the following section.

`vec<_>` is typechecker speak for, I know nothing about what is in here. I can't tell you anything useful, so I won't say anything.
This allowed you to do things like calling methods on the contents, just like `nothing` does. But, the `_` type would also show up in other situations, like untyped code. This made it look like the typechecker wasn't protecting you, like it would be in untyped code. The `nothing` type is a far more manageable way of modeling this concept.

There are more ways of creating a `nothing`. I won't show you all of them. Code after a `return` or `while(true)`, the `catch` block of an empty `try` block, and many more situation like this, are also the land of `nothing`.
