# Unsupported Features

Hack has its roots in PHP, and supports many of its features, while adding features of its own. However, there are some PHP features Hack doesn't support.

The lack of support for some features is not due to laziness. Careful decision making went into deciding which features to support and which to not support, and the general guideline for a go/no-go decision came down to the typechecker. We wanted the typechecker to be fast. We wanted the typechecker to be accurate when it came to type safety. And many of these features did not lend themselves to those guidelines.

There are a couple of **important** things to note about these unsupported features.

- They only apply to `<?hh` code; `<?php` code running on HHVM can still use the features.
- `<?php` code using these features can still interoperate with code `<?hh`.

Here is a high-level view of some of the unsupported features. Drill down to view details.

- [Top Level Code](top-level.md)
- [References (e.g., `&`)](references.md)
- [Mixing HTML with Hack](html.md)
- [Some intrinsics (e.g., `isset()`)](intrinsics.md)
- [Others](others.md)
