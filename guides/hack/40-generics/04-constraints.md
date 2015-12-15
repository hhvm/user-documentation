A generic type-constraint indicates a requirement that a type must fulfill in order to be accepted as a type argument for a given type parameter. (For example, it might have to be a given class type or a subtype of that class type, or it might have to implement a given interface.) 

There are two kinds of generic type constraints, specified by the `as` and `super` keywords, respectively. Each is discussed below. 

## Specifying Constraints via `as`

Consider the following example in which class `Complex` has one type parameter, `T`, and that has a constraint, `num`:

@@ constraints-examples/constraint.php @@

Without the `as num` constraint, a number of errors are reported, including the following: 
 * The `return` statement in method `add` performs arithmetic on a value of unknown type `T`, yet arithmetic isn't defined for all possible type arguments.
 * The `if` statement in method `__toString` compares a value of unknown type `T` with a `float`, yet such a comparison isn't defined for all possible type arguments.
 * The `return` statement in method `__toString` negates a value of unknown type `T`, yet such an operation isn't defined for all possible type arguments. Similarly, a value of unknown type `T` is being concatenated with a string.

The `run()` code creates `float` and `int` instances, respectively, of class `Complex`.

In summary, `T as U` asserts that `T` must be a subtype of `U`.

## Specifying Constraints via `super`

Unlike an `as` type constraint, `T super U` asserts that `T` must be a supertype of `U`.

This kind of constraint is rather exotic, but solves an interesting problem encountered when multiple types "collide". Here is an example of how it's used on method `concat` in the library interface type `ConstVector`:

```
interface ConstVector<+T> {
  public function concat<Tu super T>(ConstVector<Tu> $x): ConstVector<Tu>;
  // ...
}
```

Consider the case in which we call `concat` to concatenate a `Vector<float>` and a `Vector<int>`. As these have a common supertype, `num`, the `super` constraint allows the checker to determine that `num` is the inferred type of `Tu`.
