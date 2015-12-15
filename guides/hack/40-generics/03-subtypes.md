An area that may seem counter-intuitive is generics as it pertains to subtyping.

@@ subtypes-examples/intuitive.php @@

Since `int` is a subtype of [`num`](http://docs.hhvm.com/hack/types/type-system#num), the typechecker is perfectly finw with passing an `int` to a function that takes `num`. It would be fine if you pass a `float` to the function. It would also be fine if you pass one `int` and one `float` to the function.

However, do you think the typechecker should accept this?

@@ subtypes-examples/counter-intuitive.php.type-errors @@

It seems like it should be valid to pass an `Box<int>` to a function expecting a `Box<num>` since `int` is a subtype of [`num`](http://docs.hhvm.com/hack/types/type-system#num). However, in the case of generics, the subtyping relationship does not coincide with its primitive type counterparts. 

The reason is that since your generic object is passed by reference, the typechecker has no way of safely knowing whether or not you are modifying the `Box` in `addRandomToBox()` to contain something that is not a `num`. While obvious to us that we are adding an `int` within `addRandomToBox()`, the typechecker does not actually consider what is happening. So it is unsure that what is returned to us is still a `Box<int>`.

The HHVM runtime doesn't care since we [erase](/hack/generics/erasure) generics at runtime anyway.

## Immutable Collections and Arrays

Since [immutable collections](/hack/collections/classes#immutable-collections) cannot be changed and [`array`s](/hack/collections/introduction#array-typing) are passed-by-value (i.e., a copy instead of reference), generics with the subtype relationships discussed above will actually pass the typechecker. This is because the typechecker can *guarantee* that the entity will not be changed when returned to the caller.

@@ subtypes-examples/array.php @@
