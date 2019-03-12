An attribute list is a comma-separated set of attribute specifiers enclosed in `<< ... >>`, where each attribute specifier has a name and an
optional comma-separated list of values inside parentheses.  For example:

```Hack
<<A1(123), A2>>
class C {
  <<A3(true, 100)>>
  public function __construct() { ... }
  <<A4>>
  public function do_it(): void { ... }
}
```

In this example, the class `C` has two attributes: `A1` and `A2`; the constructor has one attribute, `A3`; and the method `do_it` has one attribute, `A4`.

The attribute names do not have any scope, per se. They appear only in the context of an attribute-specification, and do not hide nor conflict
with the same names used in other contexts.
