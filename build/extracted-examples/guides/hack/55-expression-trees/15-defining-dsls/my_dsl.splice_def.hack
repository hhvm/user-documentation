// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ExpressionTrees\DefiningDsls\MyDsl;

/**
 * Spliceable is this base type for all expression tree visitors.
 *
 * A visitor is a class with a visit method. This is extremely generic, so
 * visitors can choose what they want to construct.
 *
 * Typically, you'll use a concrete type rather than this interface. For
 * example:
 *
 *     $e = EtDemo`123`;
 *
 * This has type `Spliceable<EtDemoVisitor, EtDemoAst, EtDemoInt>`.
 *
 * TVisitor: The class with the `visit` method that constructs the value.
 * TResult: The type we get back when running the visitor.
 * TInfer: The inferred type of the expression, used only for type checking.
*/
interface Spliceable<TVisitor, TResult, +TInfer> {
  public function visit(TVisitor $visitor): TResult;
}
