// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\Noreturn\NoreturnVsNothing;

function i_am_a_noreturn_function(): noreturn {
  throw new \Exception('stop right here');
}

function i_return_nothing(): nothing {
  i_am_a_noreturn_function();
}

const ?int NULLABLE_INT = 0;

async function main_async(): Awaitable<void> {
  example_noreturn();
  example_nothing();
}

function example_noreturn(): int {
  $nullable_int = NULLABLE_INT;
  if ($nullable_int is null) {
    i_am_a_noreturn_function();
  }
  return $nullable_int;
}

function example_nothing(): int {
  $nullable_int = NULLABLE_INT;
  if ($nullable_int is null) {
    return i_return_nothing();
  }
  return $nullable_int;
}
