XHP provides a native XML-like representation of output (which is usually HTML). This allows UI code to be typechecked, and automatically
avoids several common issues such as cross-site scripting (XSS) and double-escaping. It also applies other validation rules, e.g., `<head>`
must contain `<title>`.

Using traditional interpolation, a simple page could look like this:

```Hack
<?hh // strict
$user_name = 'Fred';
echo "<tt>Hello <strong>$user_name</strong></tt>";
```

However, with XHP, it looks like this:

```
<?hh // strict
$user_name = 'Fred';
echo <tt>Hello <strong>{$user_name}</strong></tt>;
```

The first example uses string interpolation to output the HTML, while the second has no quotation marks&mdash;meaning that the syntax is
fully understood by Hack&mdash;but this does not mean that all you need to do is remove quotation marks. Other steps needed include:
 - Use curly braces to include variables - e.g., `"<a>$foo</a>"` becomes `<a>{$foo}</a>`.
 - As XHP is XML-like, all elements must be closed - e.g., `"<br>"` becomes `<br />`.
 - Make sure your HTML is properly nested.
 - Remove all HTML/attribute escaping - e.g., you don't need to call `htmlspecialchars` before including a variable in your XHP
output; and if you do, it will be double-escaped.

## About Namespaces

XHP currently has several issues with namespaces; we recommend that:
 - XHP classes are not declared in namespaces
 - code that use XHP classes is not namespaced.

We [plan to support namespaces](https://github.com/facebook/xhp-lib/issues/64) in the future.

## The XHP-Lib Library

While the XHP syntax is part of Hack, a large part of the implementation is in a library called XHP-Lib that needs to be installed via composer;
add `xhp-lib` to your `composer.json`, e.g:

```
$ composer require facebook/xhp-lib
```

This includes the base classes and interfaces, and definitions of standard HTML elements.

Do not use HHVM to execute composer.

## Why use XHP?

The initial reason for most users is because it is *safe by default*: all variables are automatically escaped in a
context-appropriate way (e.g., there are different rules for escaping attribute values vs. text nodes). In addition, XHP
is understood by the typechecker, making sure that you don't pass attribute values. A common example of this is `border="3"`,
but `border` is an on/off attribute, so a value of 3 doesn't make sense.

For users experienced with XHP, the biggest advantage is that it is easy to add custom 'elements' with your own behavior,
which can then be used like plain HTML elements. For example, this site defines an `<a:post>` tag that has the same interface
as a standard `<a>` tag, but makes a POST request instead of a GET request:

@@ some-basics-examples/a_post.inc.php @@

A little CSS is needed so that the `<form>` doesn't create a block element:

```
form.postLink {
  display: inline;
}
```

At this point, the new element can be used like any built-in element:

@@ some-basics-examples/a_post_usage.php @@

## Runtime Validation

Since XHP objects are first-class and not just strings, a whole slew of validation can occur to ensure that your UI does not have subtle bugs:

@@ some-basics-examples/tag-matching-validation.php.type-errors @@

The above code won't typecheck or run because the XHP validator will see that `<span>` and `<naps>` tags are mismatched; however,
the following code will typecheck correctly but fail to run, because while the tags are matched, they are not nested correctly
(according to the HTML specification), and nesting verification only happens at runtime:

@@ some-basics-examples/allowed-tag-validation.inc.php @@
@@ some-basics-examples/allowed-tag-validation.php @@

## Security

String-based entry and validation are prime candidates for cross-site scripting (XSS). You can get around this by using special
functions like [`htmlspecialchars`](http://php.net/manual/en/function.htmlspecialchars.php), but then you have to actually remember
to use those functions. XHP automatically escapes reserved HTML characters to HTML entities before output.

@@ some-basics-examples/avoid-xss.php @@
