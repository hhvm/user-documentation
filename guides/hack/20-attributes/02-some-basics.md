Programmers can invent a new kind of declarative information, called an *attribute*. Attributes can be attached to various program entities, and
information about those attributes can be retrieved at run-time via reflection (see library class `Reflection`, et al).  Consider the following example:

```Hack
<<Help("http://www.MyOnlineDocs.com/Widget.html")>>
class Widget {
  ...
}

$rc = new \ReflectionClass('Widget');
$attrHelp = $rc->getAttribute('Help');
```

An attribute is specified inside `<< ... >>`.

The method `getAttribute` returns an array containing the values corresponding to an attribute, in lexical order of their specification. As
the `Help` attribute on class `Widget` has only one value, a string, array element 0 is the string containing that string, in this case, a
URL at which the corresponding help information can be found.

A number of predefined attributes affect the way in which source code is compiled.
