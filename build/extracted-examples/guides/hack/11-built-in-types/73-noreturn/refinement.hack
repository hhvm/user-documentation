// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\Noreturn\Refinement;

<<__EntryPoint>>
async function main_async(): Awaitable<void> {
  \init_docs_autoloader();

  $nullable_int = '_' ? 0 : null;
  if (!($nullable_int is nonnull)) {
    invariant_violation('$nullable_int must not be null');
  }
  // If we didn't fall into the if above, $nullable_int must be an int.
  takes_int($nullable_int);
}

function takes_int(int $int): void {
  echo $int;
}
