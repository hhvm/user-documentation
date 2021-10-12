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

- Code must, obviously, be written in Hack, unless you are specifically writing some sort of comparison, anti-pattern, etc.
- Hack code must typecheck with `hh_client` correctly.

### Code for Guides
See our guide on [writing and embedding code samples](CODE-SAMPLES.md) into guide pages.

### Code For APIs

Adding a `.md` file to the correct subdirectory in
[`api-examples`](https://github.com/hhvm/user-documentation/tree/master/api-examples)
will cause the build script to add its content to the respective API page.

The `.md` file may contain any combination of explanatory text and any number of
code examples following the same rules as above.

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

We have a test suite to ensure consistency across the changes we make to the guides, API references, and examples.

You can run it as follows:

```
$ vendor/bin/hacktest tests/
```

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

*Normally you will use our test suit described [above](#testing-changes) to test any changes you make (because it tests our examples as well). However, sometimes it is actually faster and more explicit to test one example directly with the HHVM test runner.*

```
# Assuming you are in the user-documentation repo root

# This runs every example in the test runner.
# Won't normally need to do this; just use our test suite instead.

# Test with the typechecker
$ api-sources/hhvm/hphp/test/run --hhserver-binary-path $(which hh_server) --typechecker guides/hack/05-statements/
# Test with the runtime
$ api-sources/hhvm/hphp/test/run --hhvm-binary-path $(which hhvm) guides/hack/05-statements/
```

Here is the output you should see when you run the test runner. Assume we are running the examples in the collections topic:

```
$ hhvm api-sources/hhvm/hphp/test/run guides/hack/23-collections/
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
