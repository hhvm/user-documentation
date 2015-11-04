Whether you have direct push access to the repo or are planning to submit a pull request for some content changes, [the content task list](https://github.com/hhvm/user-documentation/issues/1) is a good place to start. If there is a topic that interests you, comment on the issue and sign up for it. 

**NOTE**: If you think new content should be added or changes to existing content needs to be made, please [file an issue](https://github.com/hhvm/user-documentation/issues/new). 

## Two Main Sections

There are two main content sections for this repo. `hhvm` is for user content on how to install, configure and use the HHVM runtime. `hack` is for user content the features and tools associated with the Hack language.

## Guidelines

- Write great content :)
- Focus on the user of Hack and HHVM; particularly, don't necessarily assume knowledge of a particular topic.
- Get your content reviewed by peers for accuracy and feedback. This only helps make better documentation for everyone.
- New topics or subtopics should follow the `##-topic/subtopic` naming convention. e.g., `03-async` or `07-guidelines.md`. This is to allow documentation generation tooling an easier way to generate things like a table of contents. If necessary, you can rename/reorder topics or subtopics if it improves the logical flow.
- Code examples are awesome.
- Code must, obviously, be written in Hack `<?hh`, unless you are specifically writing some sort of comparison, anti-pattern, etc.
- Hack code must typecheck with `hh_client` correctly.
- Code samples should be in their own file under `<subtopic>-examples` directory. For example, if you are working on content for `hack/03-async/07-guidelines.md`, then your code should be placed in `hack/03-async/guidelines-examples`.
- In the actual markdown files for a particular sub-topic, placeholders to examples should look like `@@ <sub-topic>-examples/example.php @@`, where the path to examples directory is relative to the root of the main overall topic. In the example below, the path is relative to the main `07-async` topic

```
@@ guidelines-examples/non-async-hello.php @@
```

### SCSS over CSS

Any changes to CSS should be made in the scss/ files rather than in the generated main.css file. 

### Linking Between Content

Images should be referenced in the user guide or example headers as `/public/images/imagename.png`

References from the user guide to the API docs should be referenced as:

- For classes: `../reference/class/classname/`
- For interfaces: `../reference/interface/interfacename`
- For traits: `../reference/trait/traitname`
- For methods: `../reference/[class | interface | trait]/[class | interface | trait]name/methodname`
- For functions: `../function/functionname`, where `functionname` is namespaced qualified with namespaces separated by a `.` (e.g., `HH.class_meth`)


