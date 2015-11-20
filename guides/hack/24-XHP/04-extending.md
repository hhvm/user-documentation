XHP comes with classes for all standard HTML tags, but since these are first-class objects, you can create your own XHP classes to for rendering items that are not in the standard HTML specification.

## Basics

All XHP class names start with a colon `:` and may include other `:` as well, as long as they are not adjacent. Note that this is an exception to the Hack rule where you cannot have `:` in class names.

To create a custom XHP class, you need to do the following two things:

* Your class extends `:x:element`.
* You implement the `render()` method to return an XHP Object via `XHPRoot`.

@@ extending-examples/basic.php @@

## Attributes

Your custom class may have attributes. You declare each attribute with the keyword `attribute`, followed by a type and finally the attribute name (possibly with a default value).

```
attribute <type> <name> [= default value];
```

Here are the types allowed for attributes. Note if there is a problem with using an attribute, normally an `XHPInvalidAttributeException` will be thrown.

* `bool`, `int`, `float`, `string`, `array`, `mixed` (with **no coercion** ... a `int` is not coerced into `float`, for example. You will get an `XHPInvalidAttributeException` if you try this).
* Hack [enum](../enums/introduction.md) names, checked by [`Enum::isValid()`](../enums/functions.md) at runtime.
* Custom enums inline with the attribute in the form of `enum {item, item...}`. All values must be scalar so they can be converted to strings. These enums are not Hack enums.
* Class or interface names, checked by `instanceof()`. 
* [Generic](../generics/introduction.md) types, with type arguments, although they are not enforced at runtime.

You access an attribute within code just like a normal Hack property, but prefixed with a colon `:`. 

You can specify an attribute as required with the `@required` declaration after the attribute name. If you try to render the XHP object and have not set the required attribute, then an `XHPAttributeRequiredException` will be thrown.

@@ extending-examples/attributes.php @@

### Inheritance

The easiest way to have attributes in your custom XHP class inherit attributes from an existing XHP object is to use the [`XHPHelpers` trait](#xhp-helpers).

## Children

You should declare the types that your custom class is allowed to have as children. You use the `children` declaration:

```
children (:class1, :class2);
children empty; // no children allowed
```

If you don't explicitly declare using the `children` attribute, then your class can have any child. If you try to add a child to an object that doesn't allow one or doesn't exist in its declaration list, then an `XHPInvalidChildrenException` will be thrown.

You can use some standard regex operators like `*` (zero or more), `+` (one or more) `|` (this or that) when declaring your children.

@@ extending-examples/children.php @@

### Categories

Categories in XHP are like interfaces in object-oriented languages. You can mark your custom class with any number of categories which then can be referred to from your children. You use the `category` declaration. Each category is prefixed with a `%`.

```
category %name1, %name2,...., %$nameN;
```

The categories are taken from the HTML specification (e.g., `%flow`, `%phrase`).

**NOTE**: Generally you will not be adding categories to your custom classes.

@@ extending-examples/categories.php @@

## Async

XHP and [async](../async/introduction.md) co-exist well together. When defining your XHP class, and you want to use `async`, do these two things:

* Your class must `use XHPAsync;`, the XHP async trait.
* You render with `asyncRender()` instead of `render()`, returning an `Awaitable<XHPRoot>`

@@ extending-examples/xhp-async.php @@
  
## XHP Helpers

The `XHPHelpers` trait implements three behaviors:

* Transferring attributes from one object to the object returned from its `render()` method.
* Giving each object a unique `id` attribute.
* Managing the `class` attribute.

### Attribute Transfer

Let's say you have a class that wants to inherit attributes from `:div`. You could do something like this:

@@ extending-examples/bad-attribute-transfer.php @@

The issue above is that any attribute set on `:ui:my-custom` will be lost because the `<div>` returned from `render()` will not automatically get those attributes.

Instead, you should use `XHPHelpers`.

@@ extending-examples/attribute-transfer.php @@

Now, when `:ui:my-custom` is rendered, each `:div` attribute will be transferred over, assuming that it was declared in the `render()` function. Also, an `:ui:my-custom` attribute value that is set will override the same `:div` attribute set in the `render()` function.

### Unique IDs

`XHPHelpers` has a method `getID()` that you can call to give your rendered custom XHP object a unique ID that can be referred to in other parts of your code or UI framework (e.g., CSS).

@@ extending-examples/get-id.php @@

### Class Attribute Management

`XHPHelpers` has two methods to add a class name to the `class` attribute of an XHP object. This all assumes that your custom class declares the `class` attribute directly or through inheritance. `addClass()` takes a `string` and appends that `string` to the `class` attribute; `conditionClass()` takes a `string` and a `bool` appends that `string` to the `class` attribute if the `bool` is `true`.

@@ extending-examples/add-class.php @@
