<?hh // strict

namespace Hack\UserDocumentation\Shapes\Subtyping\Examples\UndefinedAndOptional;

type MyShape = shape(
  'foo' => int,
  'bar' => int,
  ?'baz' => int,
  ...
);

function get_value(): MyShape{
  return shape(
    'foo' => 123,
    'bar' => 456,
    /* Typo of 'baz', but there's no type error: the typechecker can't know if
     * this is a typo of an optional field, or if 'baz' was intentionally
     * omitted and 'baa' is meant to be an additional field. */
    'baa' => 789,
  );
}
