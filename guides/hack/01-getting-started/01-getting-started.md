```yamlmeta
{
  "fbonly messages": [
    "Unless you are specifically working on open source Hack code, you want [Facebook's internal documentation](https://our.internmc.facebook.com/intern/wiki/First-app/) instead."
  ]
}
```
## Overview

The prerequisites you need to write and execute Hack code are pretty straightforward:

* The [HHVM runtime](../../hhvm/getting-started/getting-started.md)
* The Hack typechecker (included with HHVM packages/builds)
* Optionally, a Hack-aware editor. We recommend [Visual Studio Code] with
  [vscode-hack], and Vim with [ALE] also offers an excellent experience.

## Your First Hack Program

Let's dive right in and create your first Hack program using the following, simple steps.

### 1. Install HHVM and the Typechecker

Check out the [HHVM getting started guide](../../hhvm/getting-started/getting-started.md) on how
to install HHVM.

After you install HHVM, the Hack typechecker will be available to you, so you can statically check
your code before you run it. It is *not* a compiler; but rather, a super-fast code analyzer that tries
to catch dynamic programming errors before code is run instead of during or after.

The typechecker is called `hh_client` and is available by default alongside HHVM in all official
packages supported by the HHVM team. If you are using a community-contributed package, `hh_client`
is very likely available there too, but you should check with your package maintainer.

### 2. Setup for the Typechecker

Choose a directory where you want to store your Hack code. In this directory, run `touch .hhconfig`. This
creates an empty file that `hh_client` looks for as the *root* of your code to be typechecked. In
order to properly analyze your code, the typechecker needs to do global analysis and be able to see
all of your code. This means that it assumes a global autoloader for any code under this root, and
checks all code recursively under this root together as one project.

### 3. Write your first Hack program

Using the editor of your choice (e.g., VSCode or vim), let's create a file called `first.hack` with the following code:

@@ getting-started-examples/myfirstprogram.hack @@

This guide assumes some knowledge of programming. Hack has a very similar look and feel to PHP, which in
turn, supports a lot of syntax shared by C, C++, C#, Java, and JavaScript. Here are the key points to note about this example:

* This code belongs to the unique, but arbitrary, namespace called `Hack\GettingStarted\MyFirstProgram`.
* `main` is a function that has no parameters and, being `void`, returns no value. Furthermore, this function
is where the program will begin execution; that is, `main` is the entry-point function.
* `echo` writes some text and a blank line to standard output.
* `printf` also writes to standard output, but it provides format control, in this case, to right-justify the integer columns.
* The `for` loop has variable `$i` go from -5 to +5, in steps of 1, and for each iteration, the value
of `$i` and that value squared are written out together on a separate line.

### 4. Run the Typechecker

If you are using Visual Studio Code with vscode-hack or Vim with ALE, you will be seeing typechecking information as you write the program. If you run the typechecker from the command line, the command is just:

```
$ hh_client first.hack
```

You should see:

```
No errors!
```

### 5. Run the code in HHVM

After you get your Hack program to typecheck clean with no errors, you can then run the
program in HHVM, as follows:

```
% hhvm first.hack
```

Here is the output:

```
Welcome to Hack!

Table of Squares
----------------
  -5        25
  -4        16
  -3         9
  -2         4
  -1         1
   0         0
   1         1
   2         4
   3         9
   4        16
   5        25
----------------

```

Now, go forth and Hack away!

[Visual Studio Code]: https://code.visualstudio.com
[vscode-hack]: https://marketplace.visualstudio.com/items?itemName=pranayagarwal.vscode-hack
[ALE]: https://github.com/w0rp/ale
