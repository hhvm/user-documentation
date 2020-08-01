Here are some general guidelines to know and follow when using XHP. In addition to its [basic usage](basic-usage.md),
[available methods](methods.md) and [extending XHP with your own objects](extending.md), these are other tips to make the best use of XHP.

## Validation of Attributes and Children

The constraints of XHP object children and attributes are done at various times:
* Children constraints are validated at render-time (when `toString` is called explicitly or implicitly).
* Attribute names and types are validated when the attributes are set in a tag or via `setAttribute`.
* `@required` is validated when the required attributes are read.

This validation is on by default. You can turn it off by running the following code before using XHP:

```Hack
:xhp::$ENABLE_VALIDATION=false
```

## Use Contexts to Access Higher Level Information

If you have a parent object, and you want to give information to some object further down the UI tree (e.g., `<ul>` to `<li>`), you
can set a context for those lower objects and the lower objects can retrieve them. You use `setContext` and `getContext`

@@ guidelines-examples/context.inc.php @@
@@ guidelines-examples/context.php @@

Context is only passed down the tree at render time; this allows you to construct a tree without having to thread through data. In
general, you should only call `getContext` in the `render` method of the child.

Common uses include:
 - current user ID
 - current theme in multi-theme sites
 - current browser/device type

## Don't Add Public Methods to Your XHP Components

XHP objects should only be interacted with by their attributes, contexts, position in the tree, and rendering them. At Facebook,
we haven't yet come across any situations where public methods are a better solution than these interfaces.

## Use Inheritance Minimally

If you need an XHP object to act like another, but slightly modified, use composition. Categories and attribute cloning can
be used to provide a common interface.

## Remember No Dollar Signs

Attribute declarations look like Hack property declarations:

```Hack
public string $prop;
attribute string attr;
```

A key difference is that there is no `$` in front of the attribute name.
