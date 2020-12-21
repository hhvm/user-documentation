// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hack\ClassHHPairMethodSkip\BasicUsage;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $p = Pair {'foo', -1.5};

  // Skipping 0 returns an ImmVector of both values
  \var_dump($p->skip(0));

  // Skipping 1 returns an ImmVector of the second value
  \var_dump($p->skip(1));

  // Skipping more than 1 returns an empty ImmVector
  \var_dump($p->skip(2));
}
