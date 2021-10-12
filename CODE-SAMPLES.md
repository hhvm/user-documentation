Code samples in all `.md` files (guides as well as api-examples) should follow
this format:

~~~
```example.hack
echo "Hello world!\n";
```
~~~

The build script, when processing this `.md` file, will extract the example code
and execute it via HHVM, then include both the example code and the output in
the rendered HTML.

The file name must be specified, so that the build script knows what name to use
for the extracted file. In almost all cases, the file extension should be
`.hack`, unless the example is specifically about a feature that requires a
different extension (e.g. partial mode).

## Boilerplate

The build script automatically adds common boilerplate code to each extracted
example, e.g. the above `echo` statement would be automatically wrapped in an
`<<__EntryPoint>>` function.

## Example Output

Ideally, each code example should produce some output when HHVM runs it. For
example, a sample class definition would ideally be followed by an
`<<__EntryPoint>>` function that demonstrates its usage.

However, if this would distract too much from the purpose of the guide, it's
acceptable for some examples to not produce any output (e.g. an example class
definition without usage). The extracted example file will still be typechecked
and run, so at least we will still catch any typechecker and/or runtime errors.

In rare cases, when it's impossible to make a code sample into valid Hack code
without making it too distracting, you can include a "fake" example code block
that will not be typechecked and executed. To do this, simply omit the file
name:

~~~
```
// Example code block without a file name will not be typechecked/executed.
// Avoid these if at all possible.
```
~~~

## Namespaces

By default, the build script will put each extracted example into a unique
namespace, so each example must be standalone and *cannot* depend on others
(e.g. use a class declared in another example code block).

To override this, you can give multiple examples a shared *prefix* in their
filename followed by a period (`.`):

~~~
Here's an example class:
```example_class.definition.hack
class C {}
```
And its usage:
```example_class.usage.hack
$c = new C();
```
~~~

The build script will ignore everything after the *first* period in the filename
when generating the namespace name.

Note that this only works for examples in a single guide (single `.md` file);
there is currently no way to put examples from separate guides into a shared
namespace.

## Autoloading

HHVM requires an "autoloader" to be explicitly initialized whenever any Hack
file references definitions from another Hack file.

The build script will insert the necessary initialization code automatically
into any `<<__EntryPoint>>` function, so it is OK to rely on definitions from
other examples inside any `<<__EntryPoint>>` function or functions called by it,
**but not elsewhere**.

For example, HHVM can never successfully run a file containing e.g. a class
definition that references a parent class or other definition from another file
(this is not a limitation specific to the docs site).

~~~
```example_hierarchy.parent.hack
abstract class Parent {}
```

```example_hierarchy.child.hack
// This file will NEVER successfully run in HHVM.
final class Child extends Parent {}
```
~~~

In practice, this is fine because *running* a file containing a class definition
is generally not needed. However, it *does* mean that trying to add an
`<<__EntryPoint>>` function to `example_hierarchy.child.hack` won't work,
because HHVM will fail with an "Undefined class Parent" error before it even
reaches it.

~~~
```example_hierarchy.child.hack
// This file will NEVER successfully run in HHVM.
final class Child extends Parent {}

<<__EntryPoint>>
function main(): void {
  // This EntryPoint function is useless because HHVM will fail above.
}
```
~~~

The workaround is to put any code that depends on definitions from more than one
other example into a separate code block.

~~~
```example_hierarchy.usage.hack
$c = new Child();
```
~~~

This can also be more convenient because we can rely on the automatic
boilerplate addition by the build script, instead of manually writing the
`<<__EntryPoint>>` function header.

## Examples with Hack Errors

Examples that are expected to fail typechecking should use the `.type-errors`
extension:

~~~
```error_example.hack.type-errors
function missing_return_type() {}
```
~~~

The build script will run the Hack typechecker and include its output in the
rendered HTML (instead of HHVM runtime output).

## Supporting Files

An example code block may specify additional files to be extracted alongside the
example code using the following format:

~~~
```nondeterministic_example.hack
echo "Your lucky number is: ".\mt_rand(0, 99);
```.example.hhvm.out
Your lucky number is: 42
```.expectf
Your lucky number is: %d
```
~~~

Supported extensions are inherited from the
[HHVM test runner](https://github.com/facebook/hhvm/blob/master/hphp/test/README.md#file-layout):

- `.hhconfig` if the example requires specific *typechecker* flags
  (e.g. demonstrating a feature that is not yet enabled by default)
- `.ini` for *runtime* flags
- `.hhvm.expect` if you want to manually specify the expected output, instead of
  the build script doing it automatically
- `.hhvm.expectf` to specify the expected output using printf-style syntax, like
  in the example above
- `.expectregex` to specify the expected output using a regular expression
- `.example.hhvm.out` should contain one possible output (this will
  be included in the rendered HTML instead of the `expectf`/`expectregex` file;
  it is not needed for regular `expect` files)
- `.typechecker.expect`, `.typechecker.expectf`, `.typechecker.expectregex`,
  `.example.typechecker.out` are the same but for typechecker (Hack) output
  instead of runtime (HHVM) output; they should only be included if the example
  code is expected to fail typechecking *and* you don't want the build script to
  generate them automatically
- `.skipif` should contain valid Hack code that will print "skip" if the example
  should not be run (e.g. a MySQL example that should not run if there isn't a
  MySQL server running), otherwise print nothing
