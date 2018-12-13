Although `hh_client` can be used directly on the command line, having the immediate feedback directly in an editor can be an amazing productivity boost. If your preferred editor or IDE is unsupported, contributions of additional plugins are very welcome; the existing plugins are decent examples of how to script the `hh_client` interface.

## Visual Studio Code

[Visual Studio Code] offers a first-class experience for Hack and [HHAST], when
the [vscode-hack] extension is installed.

This is our recommended environment for users without a preference.

## Vim

We recommend using [neovim]

- [vim-hack] provides syntax highlighting
- [ALE] provides support for the typechecker and [HHAST]

ALE works best on neovim; Vim8 also works, but can have some issues such as
slow response times.

If you need to use vim7 or below, we recommend just using the vim-hack package.

## Emacs

 Emacs users can find a package in [Github](https://github.com/hhvm/hack-mode) with installation instructions in the [README](https://github.com/hhvm/hack-mode/blob/master/README.md) contained therein.

## Other Editors

If your editor supports the [Language Server Protocol], it can integrate with
the typechecker by executing `hh_client lsp --from yourEditorAndPluginNameHere`

For HHAST, we recommend looking for `$PROJECT_ROOT/vendor/bin/hhast-lint`, and:
- prompting the user, per-project, if they want to execute that (otherwise,
  opening an editor will execute arbitrary code, which can be a security
  concern)
- if the user agrees or it is otherwise considered safe, execute
  `$PROJECT_ROOT/vendor/bin/hhast-lint -m lsp`

[Language Server Protocol]: https://langserver.org
[neovim]: https://neovim.io
[HHAST]: https://github.com/hhvm/hhast/
[Visual Studio Code]: https://code.visualstudio.com
[vscode-hack]: https://marketplace.visualstudio.com/items?itemName=pranayagarwal.vscode-hack
[ALE]: https://github.com/w0rp/ale
[vim-hack]: https://github.com/hhvm/vim-hack/
