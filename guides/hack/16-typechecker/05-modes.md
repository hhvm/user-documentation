When you are writing type-checkable Hack code, a common idiom is to start your file with `<?hh` and start writing code. However, that one top line is actually quite important in how the typechecker interprets your code.

## Partial Mode

Hack code starting with the four characters `<?hh` at the top of it is said to be in *partial* mode. This means that the typechecker will check whatever it can, but no more. Partial mode is great to use to start gradually typing existing code. Here are the rules for partial mode:

- You can call functions and use classes that the typechecker cannot see (e.g., in `<?php` file)
- Top-level code is allowed, but not typechecked. 
-- To maximize the typechecker's ability in partial mode, it is common practice to wrap all top-level code into one main function and just call that function from the top level.
- You can use references `&`, but they are basically ignored as it doesn't follow the reference path. Try not to use references. 
- You can access superglobals without error.

@@ 05-modes-examples/partial.php @@
@@ 05-modes-examples/non-hack-code.php @@

Notice that we have annotated some of the code, but not all of it. [Inferred code](../01-types/04-inference.md) is checked regardless of annotations on the function itself.

**NOTE**: You can explicitly specify partial mode by `<?hh // partial`

## Strict Mode

Hack code starting with:

```
<?hh // strict
```

means that the typechecker is checking everything. If at all possible, start new projects with strict mode, assuming all code in your new project can be in Hack files. Here are the rules for strict mode:

- Any code that can be type annotated, must be annotated or you will get an error.
- All function calls, classes used, etc. must be defined in a Hack file. Thus, for example, if you use a class from a `<?php` file, you will get an error because it cannot be typechecked.
-- From strict mode, you *can* call into Hack code in partial and decl mode.
- The only code allowed at the top-level are `require`, `require_once`, `include`, `include_once`, `namespace`, `use`, and statements that define classes, functions, constants (e.g., using `const`), etc.
- No by-reference `&` anywhere.
- No accessing super globals.

Strict is actually the mode you want to strive to. The entire typechecker goodness is at your disposal and should ensure zero runtime type errors.

@@ 05-modes-examples/strict.php @@
@@ 05-modes-examples/non-hack-code.php @@

Notice that we cannot call into the `<?php` file any longer and that all entities in the Hack file are annotated.

## Decl Mode

Hack code starting with

```
<?hh // decl
```

is called decl mode. Decl mode code is not typechecked. It is used for taking existing `<?php` files and provide some typechecking benefits to code *calling* into the decl mode code. The signatures of functions and classes are read in decl mode to allow this to happen. In fact, one migration path to Hack is to just change all your `<?php` files to decl mode, then start taking each file one-by-one and making them partial. 

New Hack code should never be in decl mode.

@@ 05-modes-examples/decl.php @@
@@ 05-modes-examples/call-into-decl.php @@
@@ 05-modes-examples/main-function.php @@

The example shows all three modes. First it shows a decl mode file that used to be in `<?php`. Nothing else was added except the header change. Then it shows a strict mode file calling into the decl mode file. The typechecker knows the signatures of the functions and classes and can ensure basic things like whether you are calling a named entity and passing the right number of arguments. Finally, we have a partial mode file that actually calls the function in strict mode because we cannot have top-level function calls in strict mode.

## Mixing Modes

The decl mode example above showed that modes can be mixed. So each file in your project can be in a different typechecker mode; just make sure you are following the rules for each mode.

