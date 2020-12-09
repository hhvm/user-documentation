<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHVectorMethodReserve\BasicUsage;

const int VECTOR_SIZE = 1000;

<<__EntryPoint>>
function basic_usage_main(): void {
  \init_docs_autoloader();

  $v = Vector {};
  $v->reserve(VECTOR_SIZE);

  for ($i = 0; $i < VECTOR_SIZE; $i++) {
    $v[] = $i * 10;
  }

  \var_dump($v);
}
