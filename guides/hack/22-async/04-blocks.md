Async blocks are syntactic sugar for defining an async function and
immediately calling it.

## Syntax

The syntax for an async block is:

```
async {
  // Any statement, typically await statements.
  < statements >
}
```

## Usage

Async blocks are great for code that is conditionally asynchronous:

```
$fetch ? gen_from_database() : async { return null; };

// This is a type error, because null is not an Awaitable value
$fetch ? gen_from_database() : null;
```

You can also use them to group your asynchronous logic together:

```
list($x, $y) = Asio\va(
    gen_from_database(),
    async {
        $foo = gen_count_from_database('foo');
        $bar = gen_count_from_database('bar');
        return $foo + $bar;
    }
);
```

Without an async block, you'd need an asynchronous lambda:

```
list($x, $y) = Asio\va(
    gen_from_database(),
    (async () ==> {
        $foo = gen_count_from_database('foo');
        $bar = gen_count_from_database('bar');
        return $foo + $bar;
    })()
);
```

## Behavior

Async blocks behave the exactly same as anonymous functions that are
immediately called.

```
$x = async {
    return foo();
};

// Equivalent to:
$x = (async () ==> {
    return foo();
})();
```

## Limitations

Hack does not allow the use of an async block immediately after `==>`
in a lambda. This is to prevent confusion. Asynchronous anonymous
functions should start with `async`.

```
$x = async () ==> {...} // correct

$x = () ==> async {...} // syntax error
```
