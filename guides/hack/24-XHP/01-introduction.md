XHP provides a native XML-like representation of your output (usually HTML). This allows your UI code to be typechecked, and automatically avoids several common issues such as cross-site scripting (XSS) and double-escaping. It also applies other validation rules, e.g. `<head>` must contain `<title>`.

Compare the following:

```
<?hh
$user_name = 'Fred';
echo "<tt>Hello <strong>$user_name</strong></tt>";
```

vs.

```
<?hh
$user_name = 'Fred';
echo <tt>Hello <strong>{$user_name}</strong></tt>;
```

The first example uses string interpolation to output the HTML, while the second has no quotation marks, meaning that we have first-class objects that are part of the Hack grammar &mdash; this does not mean that all you need to do is remove quotation marks. Other steps needed include:

 - Use curly braces to include variables - e.g. `"<a>$foo</a>"` becomes `<a>{$foo}</a>`.
 - As XHP is XML-like, all elements must be closed - e.g. `"<br>"` becomes `<br />`.
 - Make sure your HTML is properly nested.
 - Remove all HTML/attribute escaping - e.g. you don't need to call `htmlspecialchars()` before including a variable in your XHP output; and if you do, it will be double-escaped.

**IMPORTANT NOTE**: In many cases, XHP does not work in namespaced code. We are aware of this, but take note that you may not be able to use XHP if your code is in a namespace.
 
## Using XHP with Hack

For most things you do with XHP, you must have the [XHP library `xhp-lib`](https://github.com/facebook/xhp-lib) included or somehow autoloaded into your codebase.

You can add the `xhp-lib` via composer:

```
"require": {
  "facebook/xhp-lib": "~2.2"
}
```

## Why use XHP?

Outputting UI through string concatenation or interpolation can be a cause of bugs and security holes. XHP allows you to avoid this type of programming by providing first-class UI objects that can be organized in an object-oriented way.

### Runtime Validation

Since XHP objects are first-class and not just strings, a whole slew of validation can occur to ensure that your UI does not have subtle bugs.

@@ introduction-examples/tag-matching-validation.php.type-errors @@

The above code won't typecheck or even run because the XHP validator will catch that `<span>` and `<naps>` tags are mismatched.

@@ introduction-examples/allowed-tag-validation.php @@

The above code *will* typecheck correctly. Tag nesting rule validation is only done at runtime.

**NOTE**: The Hack typechecker and HHVM as built in syntax checking for XHP. But most of the validation is done at runtime and requires the `xhp-lib` to be included/autoloaded in your source.

### Security

String-based entry and validation are prime candidates for cross-site scripting (XSS). You can get around this by using special functions like [`htmlspecialchars()`](http://php.net/manual/en/function.htmlspecialchars.php), but then you have to actually remember to use those functions. XHP automatically escapes reserved HTML characters to HTML entities before output.

@@ introduction-examples/avoid-xss.php @@

If you are using strings, they will be output as-is since the base Hack language makes no distinction between raw strings and HTML. XHP helps bring some sanity to this problem by understanding what strings should be escaped.
