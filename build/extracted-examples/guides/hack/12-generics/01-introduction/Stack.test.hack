// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Generics\Introduction\Stack;

function useIntStack(StackLike<int> $stInt): void {
  $stInt->push(10);
  $stInt->push(20);
  echo 'pop => '.$stInt->pop()."\n"; // 20
  $stInt->push(30);
  echo 'pop => '.$stInt->pop()."\n"; // 30
  echo 'pop => '.$stInt->pop()."\n"; // 10
  //  $stInt->push(10.5); // rejected as not being type-safe
}
