# Contributing

Whether you have direct push access to the repo or are planning to submit a [pull request](https://github.com/hhvm/user-documentation/pulls) for some content changes, [the issues list](https://github.com/hhvm/user-documentation/issues/) is a good place to start. If there is an issue that interests you, comment on the issue and sign up for it. If you want to add some new content or modify existing content that doesn't have an associated issue, please [file an issue](https://github.com/hhvm/user-documentation/issues/new) so we can keep track and go for it.

## Be Ready To Build the Site

If you want to test your changes locally, the make sure you have followed the [installation instructions](README.md#build-the-site-locally) for locally building the site.

## Two Main Sections

There are three main content sections for this repo, including two guides and one API reference:
- [`hhvm`](https://github.com/hhvm/user-documentation/tree/master/guides/hhvm) is for user content on how to install, configure and use the HHVM runtime.
- [`hack`](https://github.com/hhvm/user-documentation/tree/master/guides/hack) is for user content the features and tools associated with the Hack language.
- There is a separate subsection for `hack` that is the API reference. This API reference is generated directly from the HHVM source code. But we also have the ability to provide [examples](https://github.com/hhvm/user-documentation/tree/master/api-examples) for each API.

## General Guidelines

While we aren't 100% rigid on how we want contributions to come to us (we want to make contributing as easy as possible), there are some guidelines that we ask you follow when making contributions.

- Write great content :)
- For the [guides](https://github.com/hhvm/user-documentation/tree/master/guides), we try to remain semi-informal. Please use the second person (e.g., "you") to give the reader a feel they are being targeted directly.
- Focus on the user of Hack and HHVM; particularly, don't necessarily assume knowledge of a particular topic.
- Get your content reviewed by peers for accuracy and feedback. This only helps make better documentation for everyone.
- [Code examples](#code-examples) are awesome.
- Edit the SCSS source, instead of the generated `build/main.css` file.

## Document Structure

- New topics or subtopics should follow the `##-topic/subtopic` naming convention. e.g., `22-async` or `07-guidelines.md`. This is to allow documentation generation tooling an easier way to generate things like a table of contents. If necessary, you can rename/reorder topics or subtopics if it improves the logical flow.
- With respect to the topic numbering and Hack:
    + The `00-` topics are the more getting started topics.
    + The `20-` topics are the key feature topics.
    + The `40-` topics are additional topics.
    + There is one specialty numbering of `60-` for unsupported features.

## Code Examples

- Code must, obviously, be written in Hack `<?hh`, unless you are specifically writing some sort of comparison, anti-pattern, etc.
- Hack code must typecheck with `hh_client` correctly.

### Code for Guides

- In the guides, code samples should be in their own file under `<subtopic>-examples` directory. For example, if you are working on content for `hack/22-async/07-guidelines.md`, then your code should be placed in `hack/22-async/07-guidelines-examples`.
- In the actual guide markdown `.md` files for a particular sub-topic, placeholders to examples should look like `@@ <sub-topic>-examples/example.php @@`, where the path to examples directory is relative to the root of the main overall topic. In the example below, the path is relative to the main `22-async` topic

```
@@ guidelines-examples/non-async-hello.php @@
```

**NOTE**: You *leave off the topic number prefix* in the example path. Those numbers are for our structuring only, but if we ever change the structure, we don't have to go through all the guides and make modifications. Our tooling handles things here.

- All examples (guide and API) must be able to be run with the [HHVM test runner](https://github.com/hhvm/user-documentation#using-the-hhvm-test-runner). As such, all examples must have the following files associated with them:
    + `.php` or `.php.type-errors`: The code itself. If your code is going to purposely have type errors, use that suffix instead.
    + `.php.hhconfig`: This is an empty file for the typechecker.
    + `.php.hhvm.expect[f]`: An HHVM test runner [hhvm expect file](https://github.com/facebook/hhvm/blob/master/hphp/test/README.md#file-layout) with the expected results of running your code in HHVM.
    + `.php.typechecker.expect[f]`: An HHVM test runner [typechecker expect file](https://github.com/facebook/hhvm/blob/master/hphp/test/README.md#file-layout) with the expected results of running the typechecker on your code (e.g., in `--typechecker` mode). Most of the time this should be a file that contains `No errors!`.
    + `.php.example.hhvm.out`: If you are using an `.hhvm.expectf` file, then this file will be a raw output version of that file without any patterns. i.e., the result of running `hhvm` on the source file.
    + `.php.no.auto.output`: Don't print out any output after the source code. This supercedes `.php.example.hhvm.out` and `.hhvm.expect` (i.e., those files will be ignored when it comes to printing raw output in the docs). Use this if you want to control where the output goes, or if you want no output at all. 

The [examples associated with the async introduction](https://github.com/hhvm/user-documentation/tree/master/guides/hack/22-async/01-introduction-examples) will give you a guide on how to structure these files.

We have provided a [simple shell script](https://github.com/hhvm/user-documentation/tree/master/bin/exskel.sh) that you can run to create skeletons of all the files above for your example.

### Code For APIs 

In addition to [all the files for a guide example](#code-for-guides) above, all API examples should also have an `.md` file associated with it that serves as a header (e.g., summary) to the example itself. 

In general, follow the structure with what we did with [`Vector::splice`](https://github.com/hhvm/user-documentation/tree/master/api-examples/class.Vector/splice).

## Generated Markdown

This should be rare, but if you need to generate markdown on the fly (e.g., we do this for generating the HHVM Supported PHP INI Settings at http://docs.hhvm.com/hhvm/configuration/INI-settings#supported-php-ini-settings. 

- Create a `BuildStep` ([PHP INI setting table example](https://github.com/hhvm/user-documentation/blob/master/src/build/PHPIniSupportInHHVMBuildStep.php)) for any data you might need to generate the markdown.
- Create a `BuildStep` ([PHP INI setting table example](https://github.com/hhvm/user-documentation/blob/master/src/build/PHPIniSupportInHHVMMarkdownBuildStep.php))for manually creating the markdown to be rendered.
  + The rendered markdown should be put in the [`GUIDES_GENERATED_MARKDOWN`](https://github.com/hhvm/user-documentation/blob/master/src/build/BuildPaths.php) directory.
- Create a symlink ([example](https://github.com/hhvm/user-documentation/blob/master/guides/hhvm/04-configuration/guides-generated-markdown)) in the directory of the guide where the generated markdown will be rendered into. The symlink should point to [`GUIDES_GENERATED_MARKDOWN`](https://github.com/hhvm/user-documentation/blob/master/src/build/BuildPaths.php) directory.
- Update the actual guide that will have the generated markdown in it using the similar example syntax `@@`, but instead pointing to the `.md` file that will be inserted in the guide (as opposed to a `.php`) file. ([example](https://github.com/hhvm/user-documentation/blob/master/guides/hhvm/04-configuration/02-INI-settings.md))
- Add any test necessary ([example](https://github.com/hhvm/user-documentation/blob/master/tests/GuidePagesTest.php#L84)).

Then our rendering process will add your generated markdown to your guide.

## Linking Between Content

There are plenty of guide-to-guide links, guide-to-api links, etc. For internal links, we have a way to reference areas below. For external links, just use the absolute URL.

### Images

Images should be referenced in the user guide or example headers as `/public/images/imagename.png`

### API reference

To reference the API documentation, use the following format:

- For classes: `/hack/reference/class/<class-name>/`
- For interfaces: `/hack/reference/interface/<interface-name>/`
- For traits: `/hack/reference/trait/<trait-name>/`
- For methods: `/hack/reference/[class | interface | trait]/<class | interface | trait>-name/<method-name>/`
- For functions: `/hack/function/<function-name>/`

The names of classes, functions, etc. may be namespaced qualified (e.g., `HH.class_meth`).

### Guide Reference

To reference guide documentation, use the following format:

- For HHVM: `/hhvm/<topic>/<sub-topic>`
- For Hack: `/hack/<topic>/<sub-topic>`

The topics and subtopics *do not* have their directory named numerical prefixes associated with them.

e.g., `/hack/lambdas/creation-story`

## Testing Changes

We use PHPUnit to ensure consistency across the changes we make to the guides, API references, and examples.

### Full Test Suite

If you change any content or want to thoroughly test the code, run the full test suite:

```
$ hhvm vendor/bin/phpunit
```

### Small Test Suite

If you make a small change to the Hack code (excluding examples), you can run a smaller set of tests:

```
$ hhvm vendor/bin/phpunit --group small
```

Almost none of the content tests will run - eg internal links and examples will not be tested.

It is still good practice to run the full test suite before commit, but the small suite is handy when iterating.

### Running against an HTTP server

A subset of the tests can be ran against an HTTP server instead of locally:

```
$ REMOTE_TEST_HOST=staging.docs.hhvm.com hhvm vendor/bin/phpunit --group remote
```

### Adding new tests

Follow the examples in the other tests. Please annotate your tests with:

```
 /**
  * @large
  *
  * Add this annotation if your test takes a long time to run.
  */

 /**
  * @small
  *
  * Add this annotation if your test is quick
  */

 /**
  * @group remote
  *
  * Add this if:
  *  - your test only checks the output of page loads
  *  - your test only loads a few pages
  *
  * This will make your test automatically run against staging during the deploy process.
  *
  * If you don't want @small, you don't want this.
  */
```

These attributes can be applied to entire classes or specific methods. You might want to use `@large` for a class, but mark a specific method as `@small` `@group remote`. If you only have a `@large` test, consider making a `@group remote` test that only checks a small amount of this data. The data should be intentionally chosen, not random, as we hate intermittent failures.

## Running the Examples

Nearly all of the code examples you see in the guides and API documentation are actual Hack or PHP source files that are embedded at site build time into the content itself.

As opposed to embedded the code examples directly within the markdown itself, this provides the flexibility of actually having running examples within this repo.

You must have HHVM installed in order to run these examples since most of them are written in Hack (e.g., `<?hh`), and HHVM is the only runtime to currently support Hack.

You will find the examples in directories named with the pattern:

```
guides/[hhvm | hack]/##-topic/##-subtopic-examples
```

e.g.,

```
$ guides/hack/23-collections/06-constructing-examples
```

### Standalone

You can run any example standalone. For example:

```
# Assuming you are in the user-documentation repo directory
% cd guides/hack/23-collections/10-examples-examples/
% hhvm lazy.php
```

And you will see output like:

```
object(HH\Vector)#4 (5) {
  [0]=>
  int(0)
  [1]=>
  int(2)
  [2]=>
  int(4)
  [3]=>
  int(6)
  [4]=>
  int(8)
}
Time non lazy: 0.10859489440918
object(HH\Vector)#10 (5) {
  [0]=>
  int(0)
  [1]=>
  int(2)
  [2]=>
  int(4)
  [3]=>
  int(6)
  [4]=>
  int(8)
}
Time non lazy: 0.0096559524536133
```

### Using the HHVM Test Runner

Each example is structured to be run with the [HHVM test runner](https://github.com/facebook/hhvm/blob/master/hphp/test/README.md). We use the test runner internally to ensure that any changes made to HHVM do not cause a regression. The examples in the documentation here can be used for that purpose as well.

You can run the HHVM test runner on the entire suite of examples, on one directory of examples or just one example itself. 

*Normally you will use our PHPUnit testing described [above](#testing-changes) to test any changes you make (because it tests our examples as well). However, sometimes it is actually faster and more explicit to test one example directly with the HHVM test runner.*

Assuming you have installed and **compiled** HHVM from source, here is how you can run the examples with the test runner:

```
# Assuming you are in the user-documentation repo root

# This runs every example in the test runner.
# Won't normally need to do this; just use our PHPUnit testing instead.
% hhvm /path/to/hhvm/source/hphp/test/run .

# This runs every example in the test runner in typechecker mode
# Won't normally need to do this; just use our PHPUnit testing instead.
% hhvm /path/to/hhvm/source/hphp/test/run --typechecker .

# This runs all collections topic examples in the test runner
% hhvm /path/to/hhvm/source/hphp/test/run guides/hack/23-collections
# This runs all collections topic examples in test runner in typechecker mode
% hhvm /path/to/hhvm/source/hphp/test/run --typechecker guides/hack/23-collections

# This runs the specific lazy.php example in the test runner
% hhvm /path/to/hhvm/source/hphp/test/run guides/hack/23-collections/10-examples-examples/lazy.php
# This runs the specific lazy.php example in the test runner in typechecker mode
% hhvm /path/to/hhvm/source/hphp/test/run --typechecker guides/hack/23-collections/10-examples-examples/lazy.php
```

Here is the output you should see when you run the test runner. Assume we are running the examples in the collections topic:

```
$ hhvm ~/hhvm/hphp/test/run guides/hack/23-collections/
Running 32 tests in 32 threads (0 in serial)

All tests passed.
              |    |    |
             )_)  )_)  )_)
            )___))___))___)\
           )____)____)_____)\
         _____|____|____|____\\__
---------\      SHIP IT      /---------
  ^^^^^ ^^^^^^^^^^^^^^^^^^^^^
    ^^^^      ^^^^     ^^^    ^^
         ^^^^      ^^^

Total time for all executed tests as run: 11.57s
```

You can use `--verbose` to see all the tests that are running.

**NOTE** that due to some discovered bugs in HHVM and/or third-party libraries, running the test runner on *all* the examples may not give you a 100% pass rate. These bugs are being looked at.
