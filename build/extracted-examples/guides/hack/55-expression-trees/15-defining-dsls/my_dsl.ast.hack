// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ExpressionTrees\DefiningDsls\MyDsl;

abstract class MyDslAst {}

class MyDslAstBinOp extends MyDslAst {
  public function __construct(
    public MyDslAst $lhs,
    public string $operator,
    public MyDslAst $rhs,
  ) {}
}

class MyDslAstInt extends MyDslAst {
  public function __construct(public int $value) {}
}
