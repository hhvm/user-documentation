// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hack\ClassHHVectorMethodPop\BasicUsage;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $v = Vector {'red', 'green', 'blue', 'yellow'};

  $last_color = $v->pop();

  \var_dump($last_color);
  \var_dump($v);
}
