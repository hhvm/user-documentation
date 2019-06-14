A `continue` statement terminates the execution of the innermost enclosing `do`, `for`, `foreach`, or `while` statement.  For example:

@@ continue-examples/odd-values.php @@

Although a `continue` statement must not attempt to break out of a finally block, a `continue` statement can terminate a loop that is
fully contained within a finally block.
