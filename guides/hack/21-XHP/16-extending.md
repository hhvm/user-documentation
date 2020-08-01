XHP comes with classes for all standard HTML tags, but since these are first-class objects, you can create your own XHP classes for rendering
items that are not in the standard HTML specification.

## Basics

All XHP class names start with a colon `:` and may include other `:` as well, as long as they are not adjacent. Note that this is an
exception to the Hack rule where you cannot have `:` in class names.

A custom XHP class needs to do two things:
* extend `:x:element`.
* implement the method `render` to return an XHP Object via `XHPRoot`.

@@ extending-examples/basic.inc.php @@
@@ extending-examples/basic.php @@

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

### Inheritance

The easiest way to have attributes in your custom XHP class inherit attributes from an existing XHP object is to use the [`XHPHelpers` trait](#xhp-helpers).

## Children

You should declare the types that your custom class is allowed to have as children. You use the `children` declaration:

```
children (:class1, :class2);
children empty; // no children allowed
```

If you don't explicitly declare using the `children` attribute, then your class can have any child. If you try to add a child to an object
that doesn't allow one or doesn't exist in its declaration list, then an `XHPInvalidChildrenException` will be thrown.

You can use the standard regex operators `*` (zero or more), `+` (one or more) `|` (this or that) when declaring your children.

@@ extending-examples/children.inc.php @@
@@ extending-examples/children.php @@

### Categories

Categories in XHP are like interfaces in object-oriented languages. You can mark your custom class with any number of categories which then
can be referred to from your children. You use the `category` declaration. Each category is prefixed with a `%`.

```
category %name1, %name2,...., %$nameN;
```

The categories are taken from the HTML specification (e.g., `%flow`, `%phrase`).

@@ extending-examples/categories.inc.php @@
@@ extending-examples/categories.php @@

## Async

XHP and [async](../asynchronous-operations/introduction.md) co-exist well together. An async XHP class must do two additional things:
* use the `XHPAsync` trait
* implement `asyncRender: Awaitable<XHPRoot>` instead of `render: XHPRoot`

@@ extending-examples/xhp-async.inc.php @@
@@ extending-examples/xhp-async.php @@

## XHP Helpers

The `XHPHelpers` trait implements three behaviors:
* Transferring attributes from one object to the object returned from its `render` method.
* Giving each object a unique `id` attribute.
* Managing the `class` attribute.

### Attribute Transfer

Let's say you have a class that wants to inherit attributes from `:div`. You could do something like this:

@@ extending-examples/bad-attribute-transfer.inc.php @@
@@ extending-examples/bad-attribute-transfer.php @@

The issue above is that any attribute set on `:ui:my-custom` will be lost because the `<div>` returned from `render` will not automatically
get those attributes.

Instead, you should use `XHPHelpers`.

@@ extending-examples/attribute-transfer.inc.php @@
@@ extending-examples/attribute-transfer.php @@

Now, when `:ui:my-custom` is rendered, each `:div` attribute will be transferred over, assuming that it was declared in the `render`
function. Also, an `:ui:my-custom` attribute value that is set will override the same `:div` attribute set in the `render` function.

### Unique IDs

`XHPHelpers` has a method `getID` that you can call to give your rendered custom XHP object a unique ID that can be referred to in other
parts of your code or UI framework (e.g., CSS).

@@ extending-examples/get-id.inc.php @@
@@ extending-examples/get-id.php @@

### Class Attribute Management

`XHPHelpers` has two methods to add a class name to the `class` attribute of an XHP object. This all assumes that your custom class
declares the `class` attribute directly or through inheritance. `addClass` takes a `string` and appends that `string` to the `class`
attribute; `conditionClass` takes a `string` and a `bool` appends that `string` to the `class` attribute if the `bool` is `true`.

@@ extending-examples/add-class.inc.php @@
@@ extending-examples/add-class.php @@
