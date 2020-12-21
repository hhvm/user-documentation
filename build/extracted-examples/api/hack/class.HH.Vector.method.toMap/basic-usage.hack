// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hack\ClassHHVectorMethodToMap\BasicUsage;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $v = Vector {'red', 'green', 'blue', 'yellow'};

  $map = $v->toMap();

  \var_dump($map is \HH\Map<_, _>);
  \var_dump($map->keys());
  \var_dump($map);
}
