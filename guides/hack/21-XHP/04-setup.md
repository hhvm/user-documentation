## Namespace Support

Support for namespaced XHP classes (elements) is enabled by default since
HHVM 4.73. It comes with many related
[XHP changes](https://hhvm.com/blog/2020/09/02/XHP-namespaces-and-syntax.html)
compared to previous versions.

We recommend using this version or newer, since it's more thoroughly
tested and doesn't require any extra configuration, but XHP namespace support
can also be enabled in older HHVM versions (since around HHVM 4.46) by adding
the following flags to your `.hhconfig`:

```
enable_xhp_class_modifier = true
disable_xhp_element_mangling = true
```

And to `hhvm.ini` (or provided via `-d` when executing `hhvm`):

```
hhvm.hack.lang.enable_xhp_class_modifier=true
hhvm.hack.lang.disable_xhp_element_mangling=true
```

In HHVM 4.73 or newer, XHP namespace support can be disabled by setting these to
`false`.

If these flags are disabled, or using an older version of HHVM:

- XHP classes cannot be declared in namespaces (only in the global namespace)
- any code that uses XHP classes also cannot be in a namespace, as HHVM
  previously didn't have any syntax to reference XHP classes across namespaces
- note that the above two rules are not consistently enforced by the
  typechecker or the runtime, but violating them can result in various bugs
- it is, however, possible to use namespaced code from inside XHP class
  declarations

Make sure to also use the correct version of XHP-Lib (see below) based on
whether XHP namespace support is enabled in your HHVM version.

## Additional Configuration Flags

These are not enabled by default in any HHVM version, but we recommend enabling
them in any new Hack projects:

- `disable_xhp_children_declarations = true` disables the old way of declaring
  allowed children, which has been deprecated in favor of the `Facebook\XHP\ChildValidation\Validation` trait.
  See [Children](extending#children) for more information.
- `check_xhp_attribute = true` enables the typechecker to check that all
  required attributes are provided.
  Otherwise, these would only be errors at runtime.

## The XHP-Lib Library

While the XHP syntax is part of Hack, a large part of the implementation is in a
library called [XHP-Lib](https://github.com/hhvm/xhp-lib/) that needs to be
installed via Composer (add `facebook/xhp-lib` to your `composer.json` manually
or by running `composer require facebook/xhp-lib ^4.0` or `^3.0`).

This includes the base classes and interfaces, and definitions of standard HTML elements.

### XHP-Lib Version

There are currently two major supported versions of XHP-Lib:

- **XHP-Lib v4:** to be used when XHP namespace support is enabled. Declares all
  base classes, interfaces and elements in namespaces (e.g. standard HTML
  elements are in `Facebook\XHP\HTML`). It is also more strict (e.g. disallows
  most mutations after an element is rendered) and deprecates some features
  (e.g. attribute "clobbering" in `XHPHTMLHelpers`).
- **XHP-Lib v3:** to be used in older HHVM versions or when XHP namespace
  support is disabled. Declares everything in the global namespace, with the
  exception of `Facebook\XHP\ChildValidation`.

All the following guides are written with the assumption that XHP namespace
support is enabled and XHP-Lib v4 is used, but there are notes pointing out any
major differences&mdash;look for **Historical note** sections.

<span class="fbOnly fbIcon">XHP namespaces are not enabled in Facebook's WWW
repository, so all **Historical note** sections apply.</span>
