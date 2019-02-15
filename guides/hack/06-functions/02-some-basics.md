When designing and writing a program of non-trivial size and complexity, it is customary to break up the code for that program into bite-size 
chunks called *functions* (which, in some languages, are called *subroutines* or *procedures*).  A typical program is made up of a main function 
(in which the program begins execution) with *calls* to one or more user-written and/or library functions.  For example, the main function in 
an application that manages an employee-records systems might present a menu of choices that includes *Add a new employee*, *Remove an existing 
employee*, and *Change an existing employee's data*, with each such action being handled by a separate function or group of functions.  It 
is also common to put general-purpose algorithms and operations into their own functions.  Examples include string-manipulation and math functions.

When a function is called, information may be passed to it by the caller via an *argument list*, which contains one or more *argument 
expressions*, or more simply, *arguments*. These correspond by position to the *parameters* in a *parameter list* in the called function's 
definition.  For example:

@@ some-basics-examples/distance-between-Points.php @@

Function `main` contains two calls to function `create_point`.  Let's consider the first.  Calling a function requires the use of the 
[function-call operator, `()`](../expressions-and-operators/function-call.md).  Typically, this operator is preceded by the name of the 
function being called, in this case, `create_point `.  The comma-separated list of arguments goes inside the parentheses, as in `create_point(3.5, -6.2)`.

The definition of function `create_point` shows that it has two parameters, `$x` and `$y`, each having type `float`.  When that function is 
called, the first parameter, `$x`, takes on the value of the first argument, 3.5, and the second parameter, `$y`, takes on the value of the 
second argument, -6.2.  (The names of the parameters are local to the function definition.)  A similar situation exists in the call to function 
`distance` except that two `float`-pair tuple arguments are passed and expected.  Function `distance`, in turn, calls the math library function 
`sqrt` passing it a `float` value.

A function can optionally return one value only, using a `return` statement; however, as we see with `create_point`, we return a tuple value, 
which can contain an arbitrary number of values.  The library function `sqrt` returns a `float`, which is, in turn, returned by `distance`.  Note 
that `main`'s return type is declared to be `void`, which means that function does *not* return a value.

The final line calls `main`.

Note carefully, that while `tuple($x, $y)` looks like a function call, it's actually a tuple literal.

When a function is declared inside a class, interface, or trait, it is called a *method*; however, the same basic principles are involved as 
with a top-level function.  That is, methods are called using the function-call operator, they take zero or more arguments, and they return 
zero or one value.  For example:

@@ some-basics-examples/Point.php @@

Here, method `move` has two parameters of type `num`, so it can accept `int`s, `float`s, or a combination thereof.  It returns no value.  It 
is called to move a Point (such as `$p` in `main`) to a given location using an expression like `$p->move(-2.2, -4)`, which involves the 
[member-selection operator, `->`](../expressions-and-operators/member-selection.md).

A function can be *parameterized*; that is, its definition can have one or more placeholder names---called *type parameters*---that are associated 
with types via *type arguments* when that function is called. A function having such placeholder names is called a *generic function*.  For 
more information, see [generic types and functions](../generic-types-and-functions/introduction.md).

Note, Hack does *not* support function overloading; that is, multiple functions having the same name provided each has a different signature 
(that is, a different order and set of parameter types), are *not* permitted.

Asynchronous functions are discussed in [$$](../asynchronous-operations/introduction.md).
