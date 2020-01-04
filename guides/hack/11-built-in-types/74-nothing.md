The type `nothing` is the bottom type in the Hack typesystem. This means that there is no way to create a value of the type `nothing`. `nothing` only exists in the typesystem, not in the runtime.

The concept of a bottom type is quite difficult to grasp, so I'll first compare it to the supertype of everything `mixed`. `mixed` is the most general thing you can imagine with the hack typesystem. Everything "extends" `mixed` if you will. `nothing` is the exact opposite of that.

Let's work out the hierarchy of scalar types. Forget about nullable types and `dynamic` for the moment, they would make this example far more complex without adding much value.

 - `mixed` is at the top. Everything is a subtype of `mixed`, either directly (types that have no other supertypes) or indirectly (via their supertypes).
 - `num` is a subtype of `mixed`.
 - `arraykey` is a subtype of `mixed`.
 - `bool` is a subtype of `mixed`.
 - `int` is a subtype of `num` and `arraykey`.
 - `float` is a subtype of `num`.
 - `string` is a subtype of `arraykey`.
 - `nothing` is a subtype of `int`.
 - `nothing` is subtype of `float`.
 - `nothing` is a subtype of `string`.
 - `nothing` is a subtype of `bool`.

The important thing to note here is that `nothing` is never inbetween two types. `nothing` ony shows up right below a type with no other subtypes.

Okay that was all very academical, but "what can I use it for?", I hear you ask.

When making a new / empty `Container<T>`, Hack will infer its type to be `Container<nothing>`. It is not that there are actual value of type `nothing` in the `Container<T>`, it is just that this is a very nice way of modeling empty `Container<T>`s.

Should you be able to pass an empty vec where a `vec<string>` is expected? Yes, there is no element inside that is not a `string`, so that shoud be fine. You can even pass the same vec into a function that takes a `vec<bool>` since there are no elements that are not of type `bool`. What are you allowed to do with the `$nothing` of this foreach? Well, you can do anything to it. Since nothing is a subtype of everything, you can pass it to any method and do all the things you want to.

@@ nothing-examples/empty-vec.php @@

To make an interface that requires that you implement a method, without saying anything about its types. This does still make a requirement about the amount of parameters that are required parameters.

@@ nothing-examples/very-wide-interface.php @@

It is important to note that `Software::shipIt()` is not directly callable without knowing what subtype of `Software` you have.
