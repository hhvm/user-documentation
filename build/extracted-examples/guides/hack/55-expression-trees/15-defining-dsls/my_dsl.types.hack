// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ExpressionTrees\DefiningDsls\MyDsl;

interface MyDslNonnull {}

interface MyDslInt extends MyDslNonnull {
  public function __plus(MyDslInt $_): MyDslInt;
  public function __minus(MyDslInt $_): MyDslInt;
}
