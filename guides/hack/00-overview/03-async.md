### Async Programming in Hack

Async (or asynchronous to give the full title) programming is, at the very basic level, a way to have pieces of code that involve a lot of waiting (such as making a GET request to a remote web server, or database queries) run without blocking other parts of the code from executing. 

#### A Basic Example

Here's a really simple piece of code that would fetch the content of a URL and then does something with the result:

```
$x = makeGetRequest('http://example.com/a/');
$y = makeGetRequest('http://example.com/b/');

echo $x;

function makeGetRequest(string $url): string {
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  $content = curl_exec($ch);
  curl_close($ch);
  return $content;
}

```

In PHP this would proceed like this:

* First `makeGetRequest()` call for `$x`
* `makeGetRequest` reaches the `curl_exec()` step (which is where the actual web request is made) and waits for the web request to complete
* Return the content to `$x`
* Second `makeGetRequest()` call for `$y`
* `curl_exec()` causes another wait for web request to complete
* Return the content to `$y`
* Prints out `$x`

You can see how that even though the values of `$x` and `$y` do not depend on each other, the first `makeGetRequest` call has to fully complete before the second can even begin. This is pretty inefficient from an execution perspective. 

#### Making It Async

Let's take that same simple example and add in some of Hack's async magic:

```
$x = makeGetRequest('http://example.com/a/');
$y = makeGetRequest('http://example.com/b/');

$result_x = await $x;
echo $result_x;

function async makeGetRequest(string $url): Awaitable<string> {
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  $content = curl_exec($ch);
  curl_close($ch);
  return $content;
}

```

What have we added here? First let's take a look at the `makeGetRequest` function - we've added the `async` access modifier to the function declaration, and we've changed the return type to `Awaitable<string>`. 

Together these changes tell Hack that this function is asynchronous, and that it will return a string after 'awaiting' the execution of some long-running code. After the function executes, `$x` and `$y` will be of type `Awaitable<string>`, and cannot be accessed as strings would be.

The other thing we've done is to add a `$result_x` variable which equals `await $x` - this means `$result_x` will be equal to the string value of the complete `makeGetRequest` call that `$x` made, after waiting for the entire execution. 

When Hack encounters an `await`, it knows that it needs to stop and wait for an async function to finish before proceeding, but will keep going first. 

#### Why Is This Useful?

So how do we expect this modified code to proceed? Like this:

* First `makeGetRequest()` call for `$x`
* Second `makeGetRequest()` call for `$y`
* Await the completion of the `$x` call
* Print out the result of that call, `$result_x`
* `$y` call completes separately

Here are the important things to note:

* Both async calls for `$x` and `$y` can overlap and while the first is stuck on `curl_exec` the second might be executing other lines of code.
* `$x` can be handled *as soon as* it completes, rather than waiting for the unrelated `$y` call to finish.

To put it plainly then, **Async allows your code to execute potentially much more quickly**.

#### Further Reading

Our [Async Documentation](../async/introduction.md) provides much more detailed information about this feature.