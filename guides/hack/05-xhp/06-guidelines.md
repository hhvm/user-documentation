# XHP Guidelines

Here are some general guidelines to know and follow when using XHP. In addition to its [basic usage](./basic-usage.md), [typing and available methods](./typing.md) and [extending XHP with your own objects](./extending.md), these are other tips to make the best use of XHP.

## Validation of Attributes and Children

The constraints of XHP object children and attributes are done at various times:

* Children constraints are validated at render-time (when `toString()` is called explicitly or implicitly).
* Attribute names and types are validated when the attributes are set in a tag or via `setAttribute()`.
* `@required` is validated when the required attributes are read.

This validation is on by default. You can turn it off by running the following code before using XHP:

```
:xhp::$ENABLE_VALIDATION=false
```

## Use Contexts To Access Higher Level Information

If you have a parent object, and you want to give information to some object further down the UI tree (e.g., <ul> to <li>), you can set a context for those lower objects and the lower objects can retrieve them. You use `setContext()` and `getContext()`

@@ guidelines-examples/context.php @@

**NOTE**: There seems to be a bug with the above example; the propagation of the context to the child is not working correctly.

Context is only passed down the tree at render time. In general, you should only call `getContext()` in the `render()` method of the child.


## Don't Add Public Methods To Your XHP Components

Basically, your XHP classes should consist of children, attributes and a `protected render()` / `protected async renderAsync()` function. Basically, a user should be able to use tags, `toString()` and the [XHP object interfaces](./typing.md#xhp-object-interfaces) only to deal with your object.

## Use Composition

Do not inherit XHP objects from each other. Use [attributes](./extending.md#attribute-transfer) for inheritance.

## Remember No Dollar Signs

Attribute declarations look like Hack property declarations:

```
public string $prop;
attribute string attr;
```

A key difference is that there is no `$` in front of the attribute name.
