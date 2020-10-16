## Input and Output

Input and output is an active area of development in Hack; this page describes a proposed standard
API, with a prototype available in [hsl-experimental], known as "HSL IO".

[hsl-experimental]: https://github.com/hhvm/hsl-experimental/

**HSL IO is currently experimental and not recommended for general use.**.

<p class="fbOnly">HSL IO should not yet be used in Facebook www; you want
the Facebook-specific `Filesystem` class instead. Post in the usual groups
if you can't find a suitable alternative for HSL IO.</p>

HSL IO differs from most other language's standard IO libraries in two particularly significant ways:
- provide as much safety as possible through the type system instead of runtime checking. For example,
  files opened read-only are a different type to those opened write-only; read-write files are a supertype
  of both read-only- and write-only- files.
- designed primarily for asynchronous IO; blocking operations are not generally exposed.

Additional design goals include:
- be internally consistent
- reduce end-user boilerplate. For example, automatically retry calls that fail with `EAGAIN`
- make the most obvious way to do things as safe as possible
- /support/ all reasonable behavior even if unsafe
- be convenient for common cases, but not at the cost of consistency or safety

For a more detailed overview, see the documentation for `IO\Handle`; basic operations include:

@@ input-and-output-examples/hsl-io-basics.hack @@
