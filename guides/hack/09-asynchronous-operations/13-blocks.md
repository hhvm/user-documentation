Inside a lengthy async function, it's generally a good idea to group together data fetches that are independent of the rest of the 
function. This reduces unneeded waiting for I/O. 

To express this grouping inline, we would usually have to use a helper function; however, an async block allows for the immediate execution 
of a grouping of code, possibly within zero-argument, async lambdas.

## Syntax

The syntax for an async block is:

```
async {
  // grouped together calls, usually await.
  < statements >
}
```

## Usage

Async blocks have two main use-cases. Remember, this is essentially syntactic sugar to make life easier.
- Inline simple async statements that would before have required a function call to execute.
- Replace the call required by an async lambda to return an actual `Awaitable<T>`.

@@ blocks-examples/syntactic-sugar.php @@

## Limitations

The typechecker does not allow the use of an async block immediately on the right-hand side of the `==>` in a lambda-creation expression.

In async named-functions, `async` immediately precedes `function`, which, in turn, immediately precedes the parameters. In async 
lambdas, `async` also immediately precedes the parameters.

So:
```
$x = async () ==> { ... } // good
$x = () ==> async { ... } // bad  
```

Basically, this is just a safety guard to reduce the likelihood of unintended behavior.
