XHP is such a big topic that it is [discussed in detail](/hack/XHP/introduction.md) elsewhere, but a special operator (`->:`) is provided for XHP in order to access the attributes of an XHP object:


```
// Without the operator:
$variable = $xhp_object->getAttribute('attributeName');
// With the operator:
$variable = $xhp_object->:attributeName;
```

As well as making the code more concise, the typechecker understands the operator and is able to make sure the attribute value is used in a type-safe manner:

@@ XHP-attribute-access-examples/comparison.php @@

Note that this operator cannot be used in a write context. That is, the following is an error:

```
$xhp_object->:attributeName = 1;
```

We may implement support for this in the future.

## Namespaces

![Don't use Namespaces](/images/xhp-namespaces-play-nice.jpg)

Currently, XHP doesn't handle namespaces very well. So, your XHP code should generally be in the global namespace. This problem is [known](https://github.com/facebook/xhp-lib/issues/64).
