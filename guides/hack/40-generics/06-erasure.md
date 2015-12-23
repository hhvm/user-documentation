The ability to parameterize types via generics provides strong readability benefits for developers and users of your code. It also provides the [typechecker](/hack/typechecker/introduction) the necessary information to ensure that you are the code in the way it was intended. For example, having a `Box<int>` as a parameter type to a function clearly shows the type that the `Box` should contain and the typechecker can use this information as well.

However, with the exception of the return type for [async](/hack/async/introduction) functions ([`Awaitable<T>`](/hack/async/awaitables#awaitable)), support for generics is only at the typechecker level via [type annotations](/hack/types/annotations); they do not exist at runtime. Generic type parameters and arguments and stripped out (i.e., erased) before execution. Using our `Box` example above, this means that `Box<int>` really becomes `Box` at runtime, and HHVM will allow you to pass non-`int` `Box`es to the function.

@@ erasure-examples/type-erasure.php.type-errors @@

 While having the generic parameterization is certainly a great benefit, there are some limitations you need to be aware of because of type erasure at runtime. A type parameter T cannot be used in the following situations:

 * Creating instances using `new` (e.g., `new Box<int>()`).
 * Casting (e.g., `(Box<int>) $value`).
 * In a class scope, e.g., `T::aStaticMethod()`.
 * As the right-hand side of an [`instanceof Box<int>`](http://php.net/manual/en/language.operators.type.php) check.
 * As the type of a static property.
 * As the type of the exception in a catch block (e.g., `catch (T $execption)`).
