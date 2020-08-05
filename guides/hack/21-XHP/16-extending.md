XHP comes with classes for all standard HTML tags, but since these are first-class objects, you can create your own XHP classes for rendering
items that are not in the standard HTML specification.

## Basics

XHP class names must follow the same rules as any other Hack class names:
Letters, numbers and `_` are allowed and the name mustn't start with a number.

**Historical note:** Before XHP namespace support (in XHP-Lib v3), XHP class
names could also contain `:` (now a namespace separator) and `-` (now disallowed
completely). These were translated to `__` and `_` respectively at runtime (this
is called "name mangling"). For example, `<ui:big-table>` would instantiate a
global class named `xhp_ui__big_table`.

A custom XHP class needs to do three things:
* use the keywords `xhp class` instead of `class`
* extend `x\element` (`\Facebook\XHP\Core\element`) or, rarely, another
  [base class](/hack/XHP/interfaces)
* implement the method `renderAsync` to return an XHP object (`x\node`) or the
  respective method of the chosen base class

@@ extending-examples/basic.inc.php @@
@@ extending-examples/basic.php @@

**Historical note:** Before XHP namespace support (in XHP-Lib v3), use
`class :intro_plain_str` instead of `xhp class intro_plain_str` (no `xhp`
keyword, but requires a `:` prefix in the class name).

## Attributes

### Syntax

Your custom class may have attributes in a similar form to XML attributes, using the `attribute` keyword:

```
attribute <type> <name> [= default value|@required];
```

Additionally, multiple declarations can be combined:

```
attribute
  int foo,
  string bar @required;
```

### Types

XHP attributes support the following types:
* `bool`, `int`, `float`, `string`, `array`, `mixed` (with **no coercion**; an `int` is not coerced into `float`, for example. You will get
an `XHPInvalidAttributeException` if you try this).
* Hack enums
* XHP-specific enums inline with the attribute in the form of `enum {item, item...}`. All values must be scalar, so they can be converted to
strings. These enums are *not* Hack enums.
* Classes or interfaces
* Generic types, with type arguments

The typechecker will raise errors if attributes are incorrect when instantiating an element (e.g., `<a href={true} />`; because XHP allows
attributes to be set in other ways (e.g., `setAttribute`), not all problems can be caught by the typechecker, and an `XHPInvalidAttributeException`
will be thrown at runtime instead in those cases.

The `->:` operator can be used to retrieve the value of an attribute.

### Required Attributes

You can specify an attribute as required with the `@required` declaration after the attribute name. If you try to render the XHP object and
have not set the required attribute, then an `XHPAttributeRequiredException` will be thrown.

@@ extending-examples/required-attributes.inc.php @@
@@ extending-examples/required-attributes.php @@

### Nullable Attributes

For historical reasons, nullable types are inferred instead of explicitly stated. An attribute is nullable if it is not `@required` and
does not have a default value. For example:

```
attribute
  string iAmNotNullable @required,
  string iAmNotNullableEither = "foo",
  string butIAmNullable;
```

## Children

You can declare the types that your custom class is allowed to have as children
by using the `Facebook\XHP\ChildValidation\Validation` trait and implementing the
`getChildrenDeclaration()` method.

**Historical note:** Before XHP namespace support (in XHP-Lib v3), a special
`children` keyword with a regex-like syntax could be used instead
([examples](https://github.com/hhvm/xhp-lib/blob/v3.x/tests/ChildRuleTest.php)).
However, XHP-Lib v3 also supports `Facebook\XHP\ChildValidation\Validation`, and
it is therefore recommended to use it everywhere.

If you don't use the child validation trait, then your class can have any
children. If you try to add a child to an object
that doesn't allow one or it doesn't exist in its declaration list, then an `InvalidChildrenException` will be thrown during rendering.

@@ extending-examples/children.inc.php @@
@@ extending-examples/children.php @@

### Interfaces (categories)

XHP classes are encouraged to implement one or more interfaces (usually empty),
conventionally called "categories". Some common ones taken from the HTML
specification are declared in the `Facebook\XHP\HTML\Category` namespace.

Using such interfaces makes it possible to implement `getChildrenDeclaration()`
in other elements without having to manually list all possible child types, some
of which may not even exist yet.

@@ extending-examples/categories.inc.php @@
@@ extending-examples/categories.php @@

**Historical note:** Before XHP namespace support (in XHP-Lib v3), a special
`category` keyword could be used instead of an interface
(`category %name1, %name2;`).

## Async

XHP and [async](../asynchronous-operations/introduction.md) co-exist well together.
As you may have noticed, all rendering methods (`renderAsync`, `stringifyAsync`)
are declared to return an `Awaitable` and can therefore be implemented as async
functions and use `await`.

@@ extending-examples/xhp-async.inc.php @@
@@ extending-examples/xhp-async.php @@

**Historical note:** In XHP-Lib v3, most rendering methods are not async, and
therefore a special `\XHPAsync` trait must be used in XHP classes that need to
`await` something during rendering.

## HTML Helpers

The `Facebook\XHP\HTML\XHPHTMLHelpers` trait implements two behaviors:
* Giving each object a unique `id` attribute.
* Managing the `class` attribute.

**Historical note:** In XHP-Lib v3, this trait is called `\XHPHelpers`.

### Unique IDs

`XHPHTMLHelpers` has a method `getID` that you can call to give your rendered custom XHP object a unique ID that can be referred to in other
parts of your code or UI framework (e.g., CSS).

@@ extending-examples/get-id.inc.php @@
@@ extending-examples/get-id.php @@

### Class Attribute Management

`XHPHTMLHelpers` has two methods to add a class name to the `class` attribute of
an XHP object. `addClass` takes a `string` and appends that `string` to the
`class` attribute; `conditionClass` takes a `bool` and a `string`, and only
appends that `string` to the `class` attribute if the `bool` is `true`.

This is best illustrated with a standard HTML element, all of which have a
`class` attribute and use the `XHPHTMLHelpers` trait, but it works with any
XHP class, as long as it uses the trait and declares the `class` attribute
directly or through inheritance.

@@ extending-examples/add-class.php @@

## Attribute Transfer (deprecated)

*This feature is deprecated! We recommend declaring all attributes explicitly in
new XHP classes.*

Let's say you have a class that wants to inherit attributes from `<div>`. You could do something like this:

@@ extending-examples/bad-attribute-transfer.inc.php @@
@@ extending-examples/bad-attribute-transfer.php @@

`:Facebook:XHP:HTML:div` causes your class to inherit all `<div>` attributes,
however, any attribute set on `<ui:my-custom>` will be lost because the `<div>` returned from `render` will not automatically
get those attributes.

This can be addressed by using the `XHPAttributeClobbering_DEPRECATED` trait.

@@ extending-examples/attribute-transfer.inc.php @@
@@ extending-examples/attribute-transfer.php @@

Now, when `<ui:my-custom>` is rendered, each `<div>` attribute will be transferred over.
Also, any explicitly set `<ui:my-custom>` attribute value will override the same `<div>` attribute set in the `render` function.

**Historical note:** In XHP-Lib v3, this is provided by the `\XHPHelpers` trait
instead of a separate one.
