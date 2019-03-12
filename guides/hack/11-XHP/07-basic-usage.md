First, make sure that you have the [XHP Library](some-basics.md#the-xhp-lib-library) installed a dependency of your project&mdash;this defines
the various core classes of XHP, and the standard HTML components.

XHP is a syntax to create actual Hack objects, called *XHP objects*. They are meant to be used as a tree, where children can either be
other XHP objects or text nodes.

## Creating a Simple XHP Object

Instead of using the `new` operator, creating XHP looks very much like XML:

```
$my_xhp_object = <p>Hello, world</p>;
```

`$my_xhp_object` now contains an instance of the `:p` class; the initial `:` marks it as an XHP class, but is not needed when instantiating
it. It is a real object, meaning that `is_object` will return `true` and you can call methods on it.

The following example utilizes three XHP classes: `:div`, `:strong`, `:i`. Whitespace is insignificant, so you can create a readable
tree structure in your code.

@@ basic-usage-examples/basic.php @@

The `var_dump` shows that a tree of objects has been created, not an HTML/XML string. An HTML string can be produced either by simply
using `echo`/`print`, or by calling `$xhp_object->toString`.

## Dynamic Content

The examples so far have only shown static content, but usually you'll need to include something that's generated at runtime; for this,
you can use Hack expressions directly within XHP with braces:

```
<xhp_class>{$some_expression}</xhp_class>
```

This also works for attributes:

```
<xhp_class attribute={$some_expression} />
```

More complicated expressions are also supported, for example:

@@ basic-usage-examples/hack-xhp.php @@

## Attributes

Like HTML, XHP supports attributes on an XHP object. An XHP object can have zero or any number of attributes available to it. The XHP
class defines what attributes are available to objects of that class:

```
echo <input type="button" name="submit" value="OK" />;
```

Here the `:input` class has the attributes `type`, `name` and `value` as part of its class properties.

Some attributes are required, and XHP will throw an error if you use an XHP object with a required attribute but without the attribute.

## HTML Character References

In order to encode a reserved HTML character or a character that is not readily available to you, you can use HTML character references in XHP:

```
<?hh
echo <span>&hearts; &#9829; &#x2665;</span>;
```

The above uses HTML character reference encoding to print out the heart symbol using the explicit name, decimal notation, and hex notation.
