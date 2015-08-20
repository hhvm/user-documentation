In conjunction with the [typechecker](../14-typechecker/01-intro.md), the Hack language's typing capabilities is the cornerstone for every other Hack feature that is available. The primary motivation for the development of the Hack language was to be able to explicitly type various parts of your code, such that the code could be analyzed for type consistency and possible errors.

Take this pre-Hack example:

@@ intro-examples/pre-hack.php @@

The above example is a perfectly valid program that will run on HHVM (except a fatal that will occur in the last `var_dump`). However, it is unclear the intent of the programmer in many cases. For example, did the programmer really want to allow `A::foo()` to accept `string`-like `int`s. Of course, mitigation can occur through the use of checks like `is_int()` or exception throwing.

But look at this next example to see how much clearer the intent was....

@@ intro-examples/hack.php @@ 

Now we can see that the intent was to have only `int`s passed. And while the program will still run just like in the previous example, users of this API will now know what is expected. Combine adding these explicit types to methods and properties with the [Hack typechecker](../14-typechecker/01-intro.md), you have a real strong foundation for safe, dynamic programming.

To get a better feel for what types you can use in your code, and where and how to place your explicit type annotations, check out:

- [Type System](02-type-system.md)
- [Type Annotations](03-annotations.md)
