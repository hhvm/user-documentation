### Async Programming in Hack

Async (or asynchronous to give the full title) programming is, at the very basic level, a way to have pieces of code that involve a lot of waiting (such as making a GET request to a remote web server, or database queries) run without blocking other parts of the code from executing. 

#### A Basic Example

Here's a really simple piece of code that would involve a function that includes some input/output instruction that forces the code execution to wait until it is finished (sometimes also called blocking):

```
$x = makeBlockingRequest('foo');
$y = makeBlockingRequest('bar');

echo $x;

function makeBlockingRequest(string $a): string {
  // do something blocking
  return $value;
}

```

In PHP this would proceed like this:

* First `makeBlockingRequest()` call for `$x`
* `makeBlockingRequest` reaches a point where it has to wait until some I/O instruction completes before continuing. 
* Return the result to `$x`
* Second `makeBlockingRequest()` call for `$y`
* This reaches the same I/O instruction that causes it to have to wait.  
* Return the result to `$y`
* Prints out `$x`

You can see how that even though the values of `$x` and `$y` do not depend on each other, the first `makeGetRequest` call has to fully complete before the second can even begin. This is pretty inefficient from an execution perspective. 

#### Making It Async

Let's take that same simple example and add in some of Hack's async magic:

```
$x = makeBlockingRequest('foo');
$y = makeBlockingRequest('bar');

$result_x = await $x;
echo $result_x;

function async makeBlockingRequest(string $a): Awaitable<string> {
  // do something blocking
  return $value;
}

```

What have we added here? First let's take a look at the `makeBlockingRequest` function - we've added the `async` access modifier to the function declaration, and we've changed the return type to `Awaitable<string>`. 

These changes tell Hack that this function is asynchronous, and that it will return a string after 'awaiting' the execution of some long-running code. After the function executes, `$x` and `$y` will be of type `Awaitable<string>`, and cannot be accessed as strings would be.

The other thing we've done is to add a `$result_x` variable which equals `await $x` - this means `$result_x` will be equal to the string value of the complete `makeBlockingRequest` call that `$x` made, after waiting for the entire execution. 

When Hack encounters an `await`, it knows that it needs to stop and wait for an async function to finish before proceeding, but will keep going first. 

#### Why Is This Useful?

So how do we expect this modified code to proceed? Like this:

* First `makeBlockingRequest()` call for `$x`
* Second `makeBlockingRequest()` call for `$y`
* Await the completion of the `$x` call
* Print out the result of that call, `$result_x`
* `$y` call completes separately

Here are the main things to notice:

* Both `makeBlockingRequest` calls can overlap and while the first is stuck on the I/O instruction, the second might be executing other lines of code - it is very important to note that this is **not** multithreading, please read the [Async Documentation](../async/introduction.md) where we explain this more.
* `$x` can be handled *as soon as* it completes, rather than waiting for the unrelated `$y` call to finish.

To put it plainly then, **Async allows your code to execute potentially much more quickly**.

#### Further Reading

Our [Async Documentation](../async/introduction.md) provides much more detailed information about this feature, and important points about the limitations that need to be taken into consideration.