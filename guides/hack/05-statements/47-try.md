An *exception* is some unusual condition in that it is outside the ordinary expected behavior. (Examples include dealing with situations in 
which a critical resource is needed, but is unavailable, and detecting an out-of-range value for some computation.) As such, exceptions require 
special handling.

Whenever some exceptional condition is detected at runtime, an exception is thrown using [`throw`](throw.md). A designated exception handler 
can *catch* the thrown exception and service it. Among other things, the handler might recover from the situation completely (allowing the 
script to continue execution), it might perform some recovery and then throw an exception to get further help, or it might perform some 
cleanup action and terminate the script. Exceptions may be thrown on behalf of the runtime or by explicit code source code in the script.

Exception handling involves the use of the following keywords:
* `try`, which allows a *try-block* of code containing one or more possible exception generations, to be tried
* `catch`, which defines a handler for a specific type of exception thrown from the corresponding try-block or from some function it calls
* `finally`, which allows the *finally-block* of a try-block to be executed (to perform some cleanup, for example), whether or not an exception 
occurred within that try-block
* `throw`, which generates an exception of a given type, from a place called a *throw point*.

Consider the following:

@@ try-examples/simple.php @@

Here, we put the statement that might lead to an exception inside a try-block, which has associated with it one or more catch-blocks.  If and 
only an exception of that type is thrown, is the catch handler code executed.  

Consider the following hierarchy of exception-class types:

@@ try-examples/hierarchy_of_exception_classes.php @@

The order of the catch-blocks is important; they are in decreasing order of type specialization.  The optional finally-clause is executed 
**whether or not** an exception is caught.

In a catch-clause, the variable-name (such as `$fde` and `$rde` above) designates an exception variable passed in by value. This variable 
corresponds to a local variable with a scope that extends over the catch-block. During execution of the catch-block, the exception variable 
represents the exception currently being handled.

Once an exception is thrown, the runtime searches for the nearest catch-block that can handle the exception. The process begins at the current 
function level with a search for a try-block that lexically encloses the throw point. All catch-blocks associated with that try-block are 
considered in lexical order. If no catch-block is found that can handle the run-time type of the exception, the function that called the 
current function is searched for a lexically enclosing try-block that encloses the call to the current function. This process continues 
until a catch-block is found that can handle the current exception. 

If a matching catch-block is located, the runtime prepares to transfer control to the first statement of that catch-block. However, before 
execution of that catch-block can start, the runtime first executes, in order, any finally-blocks associated with try-blocks nested more 
deeply than the one that caught the exception. 

If no matching catch-block is found, the behavior is implementation-defined.
