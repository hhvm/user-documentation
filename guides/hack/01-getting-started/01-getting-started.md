If you are new to Hack, this getting started guide should help you get familiar with the basics quickly; if you haven't yet please read our [introduction to Hack's main features](../overview/) and afterwards you can [dive deeper into](/hack/) topics of interest to gain more knowledge on what Hack has to offer. 

## Overview

The prerequisites you need to write and execute Hack code is pretty straightforward:

* The [HHVM runtime](../../hhvm/getting-started/getting-started.md)
* The Hack [typechecker](../typechecker/introduction.md) (included as part of the build of the HHVM runtime)
* Optionally, a Hack-aware editor. We recommend [Visual Studio Code] with
  [vscode-hack], and Vim with [ALE] also offers an excellent experience.

The HHVM runtime is required for both (1) executing Hack code (2) to run the Hack typechecker, which is the cornerstone benefit of using the Hack language -- to make sure your code is well written, safe and consistent.

#### Try our Interactive Hack Tutorial

You can actually start learning Hack without having to install any software. Just head over to the [interactive Hack tutorial](http://hacklang.org/tutorial.html) to learn step-by-step about some of the Hack features.

## Your First Hack Program

Let's dive right in and create your first Hack program in five simple steps.

### 1. Install HHVM and the Typechecker

Check out the [HHVM getting started guide](../../hhvm/getting-started/getting-started.md) on how to install HHVM. 

After you install HHVM, the Hack typechecker will be available to you to statically check your code before you run it. It is *not* a compiler; but rather a super-fast code analyzer that tries to catch dynamic programming errors before code is run instead of during or after.

The typechecker is called `hh_client` and is available by default alongside HHVM in all official packages supported by the HHVM team. If you are using a community-contributed package, `hh_client` is very likely available there too, but you should check with your package maintainer.

### 2. Setup for the Typechecker

Choose a directory where you want to store your Hack code. In this directory, run `touch .hhconfig`. This creates an empty file that `hh_client` looks for as the *root* of your code to being typechecking. In order to properly analyze your code, the typechecker needs to do global analysis and be able to see all of your code. This means that it assumes a global autoloader for any code under this root, and checks all code recursively under this root together as one project.

### 3. Write your first Hack program

Using the editor of your choice (e.g., VSCode orvim), let's create a file called `first.php` with the following code:

@@ getting-started-examples/first.php @@

This getting started guide assumes some knowledge of programming (e.g., what a class is, what a function or method is, etc.). If you are familiar with [PHP](http://php.net), Hack has a similar look and feel. If you are not familiar with PHP, then all of this is new, but hopefully the general constructs are familiar to you. The comments provide various details, but here are the key points:

* This example creates a [class](http://php.net/manual/en/language.oop5.basic.php) called `Box`.
* The `Box` class is [generic](/hack/generics/introduction).
* [Constructor parameter promotion](/hack/other-features/constructor-parameter-promotion) was used on the class constructor.
* [Type annotations](/hack/types/annotations) were used everywhere, for function parameters and return types.

### 4. Run the Typechecker

If you are using Visual Studio Code with vscode-hack or Vim with ALE, you will be seeing typechecking information as you write the program. If you run the typechecker from the command line, the command is just:

```
% hh_client
```

You should see:

```
No errors!
```

Now imagine if we changed the return type of `get_int()` to be a `bool` instead of an `int`. If you run the typechecker, you will see something like this:

```
first.php:15:10,11: Invalid return type (Typing[4110])
  first.php:14:21,24: This is a bool
  first.php:15:10,11: It is incompatible with an int
```

This demonstrates the power of the Hack type system and typechecker: it lets you know that you might not be returning what you think you are returning. The typechecker makes these checks all over your codebase, for all your code, without having to run it.

### 5. Run the code in HHVM

After you get your Hack program to typecheck clean with no errors, you can then run the program in HHVM.

```
% hhvm first.php
```

And here is the output:

```
int(42)
```

## Learn More

Now that you have gotten your feet wet with a simple Hack program, the best resource for continuing to learn Hack is to keep reading our [official Hack documentation](/hack/). Here are the best places to start:

* [Introduction to Hack's features](../overview/)
* [Tools to help you write Hack](../tools/introduction.md)
* [Your frequent questions about Hack](../FAQ/faq.md)
* [Hack's strong typing system](../types/type-system.md)
* [Asynchronous Programming with Hack](../async/introduction.md)
* [Collections in Hack](../collections/introduction.md)

There is also an awesome [book on HHVM and Hack](http://www.amazon.com/Hack-HHVM-Programming-Productivity-Breaking/dp/1491920874/), written by an engineer on the HHVM team. For PHP, [PHP's documentation](http://docs.php.net/manual/en/getting-started.php) contains an introduction to PHP, and there are numerous tutorials online. [Hack has an online interactive tutorial](http://hacklang.org/tutorial.html) as well.

[Visual Studio Code]: https://code.visualstudio.com
[vscode-hack]: https://marketplace.visualstudio.com/items?itemName=pranayagarwal.vscode-hack
[ALE]: https://github.com/w0rp/ale
