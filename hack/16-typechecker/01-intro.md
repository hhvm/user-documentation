The Hack typechecker is the primary tool that makes Hack such a unique language. Before run time, the typechecker analyzes all the code associated with your program for various typing errors, thus preventing nasty bugs that may only have been exposed at run time. 

Without the typechecker, this simple example would fail at runtime.

@@ intro-examples/runtime-fail.php @@

However, when using the typechecker before you run your code, you can catch errors before deployment, saving users from nasty fatals that may occur.

@@ intro-examples/typechecker-catch.php @@

The typechecker statically analyzes your program, catching problems in all paths of your code. This **is not** compilation. It is super fast feedback on the various states that might occur in your program so you can handle them *before* your code is run. The typechecker literally monitors changes to your code and updates its analysis accordingly, in real time.

Combined with the power of [type annotations](01-types.md), the typechecker is a powerful error-catching tool.
