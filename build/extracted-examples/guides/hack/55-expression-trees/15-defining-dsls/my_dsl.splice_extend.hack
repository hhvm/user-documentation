// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ExpressionTrees\DefiningDsls\MyDsl;

class MyDslExprTree<+T> implements Spliceable<MyDsl, MyDslAst, T> {
  public function __construct(
    public ?ExprPos $pos,
    private (function(MyDsl): MyDslAst) $builder,
  ) {}

  public function visit(MyDsl $v): MyDslAst {
    return ($this->builder)($v);
  }
}
