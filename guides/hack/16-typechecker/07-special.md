There are times when you might want to just tell the typechecker to be quiet and move on. The most common case is when you know there is a typechecker error, you are not going to fix it for whatever reason, but you still want your code to be clean from typechecker errors when running `hh_client` ... e.g., you want the `No errors!` output.

There are two ways to silence the typechecker. One is more action-focused than the other.

## `HH_FIXME`

`HH_FIXME` is the silencer you should normally use. It is meant to be used temporary reprieve from the wrath of typechecker errors so you can maintain an error-free codebase from the typechecker perspective.

The syntax for `HH_FIXME` is:

```
/* HH_FIXME[error #] string comment */
<block of code>
```

The error code is retrieved from the actual error message you receive when running `hh_client`. The string comment can be anything you want, but usually explains why you are using `HH_FIXME` to begin with.

@@ 07-special-example/hhfixme.php.type-errors @@

Let's assume that we were in [partial](05-modes.md#partial) mode and now we want to make this file [strict](05-modes.md#strict), but we know that call sites will be affected by the annotation of the function because we did some questionable type conversions. We don't want to fix this yet or we don't know how to fix it (although you should fix before runtime since it will now be a runtime error). So we apply `HH_FIXME` to all the call sites that were affected by the change so that you or someone else knows that they need to be fixed. 

Without `HH_FIXME`, you would have seen something like:

```
hhfixme.php:21:14,14: Invalid argument (Typing[4110])
  hhfixme.php:15:22,27: This is a string
  hhfixme.php:21:14,14: It is incompatible with an int
hhfixme.php:26:14,17: Invalid argument (Typing[4110])
  hhfixme.php:15:22,27: This is a string
  hhfixme.php:26:14,17: It is incompatible with a bool
hhfixme.php:29:1,15: Remove all toplevel statements except for requires (Parsing[1002])
```

In this example, you could have also placed the `HH_FIXME` comment on the function itself, with the same effect. But usually it is best to place `HH_FIXME` on the most specific block possible.

**NOTE**: You can have multiple `HH_FIXME` comments on a single line of code, representing the silencing of multiple Hack errors. 

## `UNSAFE`

`UNSAFE` silences the typechecker too. But it isn't an action-to-be-taken silencing mechanism. When using `UNSAFE`, you are basically saying that you know this is a problem, and you are just going to leave it that way. 

The syntax for `UNSAFE` is:

```
// UNSAFE
<some block of code>
```

@@ 07-special-examples/unsafe.php @@

Using the example similar to `HH_FIXME`, we replaced two of the three with `UNSAFE`. Why not the third one? Well, `UNSAFE` isn't as powerful as `HH_FIXME`. `UNSAFE` cannot be used on top-level code.

Try not to use `UNSAFE`, opting for `HH_FIXME` instead. `UNSAFE` is less verbose and detailed than `HH_FIXME`, which might cause an issue for anyone maybe wanting to try to fix the problem later.

**NOTE**: It is very possible that `UNSAFE` may be deprecated or removed in the future. So all new silencing should be done with `HH_FIXME`.
