<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\Nothing\ThrowAsAnExpression;

function throw_as_an_expression(\Throwable $t): nothing {
  throw $t;
}

function returns_an_int(?int $nullable_int): int {
  // You can not use a `throw` statement in an expression bodied lambda.
  // You need to add curly braces to allow a `throw` statement.
  $throwing_lambda = () ==> {
    throw new \Exception();
  };

  $throwing_expr_lambda = () ==> throw_as_an_expression(new \Exception());

  // You can't write a statement on the RHS of an operator, because it operates on expressions.
  // The type of the `??` operator is `(nothing & int)`, which simplifies to `int`,
  // so this return statement is valid.
  return $nullable_int ?? throw_as_an_expression(new \Exception());
}

<<__EntryPoint>>
async function main_async(): Awaitable<void> {
  \init_docs_autoloader();

  echo returns_an_int(1);
}
