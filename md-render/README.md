Markdown Rendering
==================

How Do I Use This?
------------------

See the root README.md for installation instructions. Once dependencies
are installed, use as follows:

```
$ ./render.rb path/to/foo.md > foo.html
```

Why Is This Ruby?
-----------------

We wanted:

 - GitHub-compatible markdown, as our users are familiar with it
 - Syntax highlight for Hack source
 - An extensible pipeline so that we can add custom markup - for example, the
   long-form documentation uses `@@ foo-examples/bar.php @@` to include an
   example

The easiest way to make sure our Markdown is compatible is to use the same
Markdown renderer, and GitHub's is in Ruby. We also use the same pipeline
as GitHub (https://github.com/jch/html-pipeline), and a fork of their old
approach to highlighting code (https://github.com/tmm1/pygments.rb).
