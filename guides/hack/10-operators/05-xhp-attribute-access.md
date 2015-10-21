# XHP Attribute Access

XHP is such a big topic that it is [discussed in detail](../xhp/intro.md) elsewhere, but there is a special operator provided for XHP in order to access the attributes of an XHP object. 

The operator is:

```
->:<XHP attribute>
```

This operator brings some conciseness, but more importantly, typechecking coverage is improved over the call it replaces `getAttribute("XHPAttributeName")`. Plumbing has been added to the typechecker with first-class support for XHP attributes and this operator.

@@ xhp-attribute-access-examples/comparison.php @@

## Namespaces

![Don't use Namespaces](images/xhp-namespaces-play-nice.jpg)

Currently, XHP doesn't handle namespaces very well. So, your XHP code should generally be in the global namespace. This problem is [known](https://github.com/facebook/xhp-lib/issues/64).
