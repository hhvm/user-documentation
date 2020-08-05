## Namespace Support

Support for namespaced XHP classes (elements) has only recently been added to
HHVM (as of HHVM 4.68). Depending on the exact HHVM version, it may not be
enabled by default, so make sure to add these flags to your `.hhconfig`:

```
enable_xhp_class_modifier=true
disable_xhp_element_mangling=true
disable_xhp_children_declarations=true
check_xhp_attribute=true
```

And to `hhvm.ini` (or provided via `-d` when executing `hhvm`):

```
hhvm.hack.lang.enable_xhp_class_modifier=true
hhvm.hack.lang.disable_xhp_element_mangling=true
```

Using a subset of these flags might work, but is not officially supported and
tested, so we currently recommend using either all or none of them.

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

## The XHP-Lib Library

While the XHP syntax is part of Hack, a large part of the implementation is in a
library called [XHP-Lib](https://github.com/hhvm/xhp-lib/) that needs to be
installed via composer; add `xhp-lib` to your `composer.json`, e.g:

```
$ composer require facebook/xhp-lib
# note: make sure to use PHP, not HHVM, to execute composer
```

This includes the base classes and interfaces, and definitions of standard HTML elements.

### XHP-Lib Version

There are currently two major supported versions of XHP-Lib:

- **XHP-Lib v4:** to be used when XHP namespace support is enabled. Declares all
  base classes, interfaces and elements in namespaces (e.g. standard HTML
  elements are in `Facebook\XHP\HTML`). It is also more strict (e.g. disallows
  most mutations after an element is rendered) and deprecates some features
  (e.g. attribute transfer).
- **XHP-Lib v3:** to be used in older HHVM versions or when XHP namespace
  support is disabled. Declares everything in the global namespace, with the
  exception of `Facebook\XHP\ChildValidation`.

All the following guides are written with the assumption that XHP namespace
support is enabled and XHP-Lib v4 is used, but there are notes pointing out any
major differences&mdash;look for **Historical note** sections.
