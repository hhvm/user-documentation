# Lambda

Lambdas are an important feature of Hack and, as such, are [discussed in detail](../lambdas/introduction.md) elsewhere. Here is a quick look at the lambda operator.

The operator is:

```
==>
```

It is used to reduce a bit of the verbosity that generally comes with using the canonical closure form, plus provide some other benefits as well. So, what was written as:

```
<?php
$user = 'Joel';
$greeting = function() use ($user) {
  return 'Hello $user';
};
echo $greeting();
```

can now be written as:

```
<?hh
$user = 'Joel';
$greeting = () ==> "Hello $user";
echo $greeting();
```

Basically, the `==>` is a substitute for `function` and `use`. Variables are captured implicitly. The `()` means no arguments are to be passed to the lambda.
