# Async Blocks

Inside a lengthy async function, it's generally a good idea to group together data fetches that are independent of the rest of the function. This reduces unneeded waiting for I/O. 

To express this grouping inline, you would usually have to use a helper function. Async blocks allow for the immediate execution of a grouping of code, possibly within zero-argument, async lambdas.

## Syntax

The syntax for an async block is:

```
async {
  // grouped together calls, usually await.
  < statements >
}
```

## Usage

Async blocks have two primary use cases. Remember this is essentially syntatic sugar to make your life easier.

- Inline simple async statements that would before have required a function call to execute.
- Replace the call required by an async lambda to return an actual `Awaitable<T>`.

@@ blocks-examples/syntactic-sugar.php @@

## Limitations

The typechecker does not allow the use of an async block immediately on the right-hand side of the `==>` in a lambda.

In async functions declared with the `function` keyword, `async` immediately precedes `function`, which in turn immediately precedes the arguments. In async lambdas, `async` also immediately precedes the arguments.

So:

```
$x = async () ==> {...} // good
$x = () ==> async {...} // bad  
```

Basically this is just a safety guard to reduce the likelihood of unintended behavior.
