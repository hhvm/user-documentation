Markdown Rendering
==================

This is going to need to be automated before deployment. For now, here's an
FAQ:

How Do I Install The Dependencies?
----------------------------------

First, install Bundler (roughly a Ruby equivalent of Composer) if you haven't
already:

```
$ gem install --user-install bundler
Fetching: bundler-1.10.6.gem (100%)
WARNING:  You don't have /home/fred/.gem/ruby/1.9.1/bin in your PATH,
    gem executables will not run.
    Successfully installed bundler-1.10.6
    1 gem installed
    Installing ri documentation for bundler-1.10.6...
    Installing RDoc documentation for bundler-1.10.6...
```

If you get a similar `WARNING`, modify your `$PATH` variable to include that
directory.

Then, install this project's dependencies:

```
md-render$ bundle --path vendor/
Using i18n 0.7.0
Using json 1.8.2
Using minitest 5.5.1
Using thread_safe 0.3.4
Using tzinfo 1.2.2
Using activesupport 4.2.0
Using charlock_holmes 0.7.3
Using escape_utils 1.0.1
Using mime-types 2.4.3
Using rugged 0.22.0b5
Using github-linguist 4.4.2
Using github-markdown 0.6.8
Using mini_portile 0.6.2
Using nokogiri 1.6.6.2
Using html-pipeline 1.9.0
Using bundler 1.10.6
Bundle complete! 3 Gemfile dependencies, 16 gems now installed.
Use `bundle show [gemname]` to see where a bundled gem is installed.
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
