Whether you have direct push access to the repo or are planning to submit a [pull request](https://github.com/hhvm/user-documentation/pulls) for some content changes, [the issues list](https://github.com/hhvm/user-documentation/issues/) is a good place to start. If there is an issue that interests you, comment on the issue and sign up for it. If you want to add some new content or modify existing content that doesn't have an associated issue, please [file an issue](https://github.com/hhvm/user-documentation/issues/new) so we can keep track and go for it.

## Two Main Sections

There are three main content sections for this repo, including two guides and one API reference:
- [`hhvm`](https://github.com/hhvm/user-documentation/tree/master/guides/hhvm) is for user content on how to install, configure and use the HHVM runtime.
- [`hack`](https://github.com/hhvm/user-documentation/tree/master/guides/hack) is for user content the features and tools associated with the Hack language.
- There is a separate subsection for `hack` that is the API reference. This API reference is generated directly from the HHVM source code. But we also have the ability to provide [examples](https://github.com/hhvm/user-documentation/tree/master/guides/hack/99-api-examples) for each API.

## General Guidelines

While we aren't 100% rigid on how we want contributions to come to us (we want to make contributing as easy as possible), there are some guidelines that we ask you follow when making contributions.

- Write great content :)
- For the [guides](https://github.com/hhvm/user-documentation/tree/master/guides), we try to remain semi-informal. Please use the second person (e.g., "you") to give the reader a feel they are being targeted directly.
- Focus on the user of Hack and HHVM; particularly, don't necessarily assume knowledge of a particular topic.
- Get your content reviewed by peers for accuracy and feedback. This only helps make better documentation for everyone.
- [Code examples](#code-examples) are awesome.

## Document Structure

- New topics or subtopics should follow the `##-topic/subtopic` naming convention. e.g., `22-async` or `07-guidelines.md`. This is to allow documentation generation tooling an easier way to generate things like a table of contents. If necessary, you can rename/reorder topics or subtopics if it improves the logical flow.
- With respect to the topic numbering and Hack:
    + The `00-` topics are the more getting started topics.
    + The `20-` topics are the key feature topics.
    + The `40-` topics are additional topics.
    + There are two specialty numberings of `60-` and `99-`, for unsupported features and API reference respectively.

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

In general, follow the structure with what we did with [`Vector::splice`](https://github.com/hhvm/user-documentation/tree/master/guides/hack/99-api-examples/class.Vector/splice).

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
