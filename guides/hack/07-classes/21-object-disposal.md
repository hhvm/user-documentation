Modern programming languages allow resources to be allocated at runtime, under programmer control. However, in the case where 
explicit action must be taken to free such resources, different languages have different approaches. Some languages use a 
*destructor* for cleanup, while others use a *finalizer*, which is called by a garbage collector, sometime, maybe! Hack uses 
a *dispose* approach, which is tied to object scope.

In the following example, we define and use type `TextFile` to encapsulate a text file. When we are done with such a file, 
we need to make sure that output buffers are flushed, among other things. Let us call these tasks *object cleanup*.  (The 
example is skeletal; it has only the minimal machinery needed to demonstrate object disposal.)

@@ object-disposal-examples/TextFile.php @@

A class for which we wish to provide cleanup *must* implement the interface `IDisposable`, which requires that class to 
define a public method called `__dispose`, with the signature as shown.

As expected, the constructor initializes the new object's state. (Note that because the physical-file open details have been 
omitted, each instance gets the hard-coded handle value of 55 rather than a unique value.)

Method `close` provides a way to do cleanup under programmer control, **presuming the programmer remembers to do that!** H
owever, we provide a mechanism via the `openFlag` property to be sure we're not trying to cleanup more than once.

Let's look at the `using` block at the start of function `main`. The expression controlling that construct *must* have a type 
that implements the interface `IDisposable`, and the scope of the local variable `$f1` is the using block.  Note the commented-out 
trace statement at the start of the block. Under the hood, we're trying to pass a copy of a TextFile to `echo`, but `echo` 
doesn't know anything about TextFile's object cleanup, so that is rejected. We can, however, call a method on that object, 
which is why `__toString` is called explicitly in the statement following. (Later, we'll show how to allow copying of objects 
needing cleanup.)

When we are done with the file, we call `close`, which performs the necessary cleanup. Then if/when we call `close` again, no 
new work is done. Finally, at the end of the `using` block, `$f1` goes out of scope and the runtime calls `$f1->__dispose`, 
which, in our case, simply calls `close`.

The second `using` block is much like the first except it doesn't call `close`. Of course, the implicit call to `__dispose` 
does that, and the cleanup is performed then.

Rather than calling the constructor to create a new instance, the third `using` block calls what is known as a *factory method*, 
`open_TextFile`. The challenge here is that method is returning an object with associated resources, and the consumer of that 
object must be ready to handle that object's cleanup or pass it on to someone who can. To allow such a method call, we must 
declare that it is okay to return an object subject to cleanup; we do with by marking the method with the attribute 
`<<__ReturnDisposable>>`, as shown.

Note that once we've marked a class as implementing `IDisposable`, we can *only* instantiate that class in a `using` 
clause's controlling expression or in an appropriately annotated factory method. 

Thus far, we've processed one file at a time, but what if we wish to work with multiple text files at the same time? The 
fourth and fifth `using` clauses involving `$f4` and `$f5` show how. Instead of having an associated block to limit the scope, 
these statements end in a semicolon. As such, their local variables go out of scope at the end of their parent block, in this 
case, at the end of `main`, at which time, `__dispose` is called for each of them. Note carefully though, that the order in which 
these two calls are made is unspecified.

Earlier, we discussed the problem of making copies of objects needing cleanup. Consider the method `is_same_TextFile`, which is 
called on one TextFile and is explicitly passed a second TextFile.  By marking the parameter with the attribute `<<__AcceptDisposable>>`, 
we promise that we've taken care of cleanup elsewhere. That is, when the copy goes out of scope, `__dispose` must **not** be called.

If classes in a class hierarchy need cleanup, it is the responsibility of the dispose method at each level to call the dispose 
in its base class explicitly. 

For objects of a class type to be used in an asynchronous context, that type must implement interface `IAsyncDisposable` instead, 
which requires a public method called `__disposeAsync` to be defined with the following signature:

```Hack
public async function __disposeAsync(): Awaitable<void>;
```

Now, related `using` clauses *must* be preceded by `await`. 
