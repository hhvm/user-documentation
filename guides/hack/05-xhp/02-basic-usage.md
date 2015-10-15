# Basic XHP Usage

**NOTE**: Make sure that you have the [XHP Library](../intro.md#xhp-library) available when using XHP. Otherwise you will get a lot of `Fatal error: Class undefined: xhp_xxxx` type of errors.

XHP is a syntax to create actual Hack objects, called XHP objects. They are meant to be a tree-based object, with each child as text or another XHP object.They are first-class, meaning that:

* you can call methods on XHP objects
* you can call the `is_xxx` methods on them (e.g. `is_object()`).
* they are instances of XHP clases, with names starting with `:` and all are children of `:xhp`.

You create the XHP objects with XHP tags instead of `new`.

## Creating a Simple XHP Object

If you know HTML or XML, the structure of XHP is quite similar. The most basic XHP object consists of:

```
<xhp_class_name></xhp_class_name>
```

where `xhp_class_name` is an XHP class *without* the prepending `:`.

@@ basic-usage-examples/basic.php @@

The following example utilizes three XHP classes: `:div`, `:strong`, `:i`. Whitespace is insignificant so you can create a readable tree structure in your code.

We are using `var_dump()` on the XHP object, and you will notice that the output is full of XHP and other Hack objects.

## HTML Character References

In order to encode a reserved HTML character or a character that is not readily available to you, you can use HTML character references in XHP. 

```
<?hh
echo <span>&hearts; &#9829; &#x2665;</span>;
```

The above uses HTML character reference encoding to print out the heart symbol using the explicit name, decimal notation and hex notation.

## Attributes

Like HTML, XHP supports attributes on an XHP object. An XHP object can have zero to an unlimited number of attributes available to it. The XHP class defines what attributes are available to objects of that class.

```
echo <input type="button" name="submit" value="OK" />;
```

Here the `:input` class has the attributes `type`, `name` and `value` as part of its class properties.

Some attributes are required, and XHP will throw an error if you use an XHP object with a required attribute without the attribute.

## Mixing Hack with XHP

You can use Hack expressions directly within XHP. To do this, you enclose the Hack expression in curly braces:

```
<xhp_class>{Hack expression}</xhp_class>
```

@@ basic-usage-examples/hack-xhp.php @@

Notice how we are calling class methods, functions and embedding one XHP object into the other.
