## WARNING WARNING WARNING

This section is under active development and represents an unreleased feature

## Back to your regularly scheduled docs


Additionally, the context list may appear in a function type:

function has_fn_args(
  (function (): void) $no_list,
  (function ()[io, rand]: void) $list,
  (function ()[]: void) $empty_list,
): void {...}