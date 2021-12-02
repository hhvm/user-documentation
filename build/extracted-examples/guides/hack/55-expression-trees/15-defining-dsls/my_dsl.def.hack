// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ExpressionTrees\DefiningDsls\MyDsl;

type ExprPos = shape(...);

class MyDsl {
  public function visitBinop(
    ?ExprPos $_pos,
    MyDslAst $lhs,
    string $operator,
    MyDslAst $rhs,
  ): MyDslAst {
    return new MyDslAstBinOp($lhs, $operator, $rhs);
  }

  public function visitInt(?ExprPos $_pos, int $value): MyDslAst {
    return new MyDslAstInt($value);
  }
}
