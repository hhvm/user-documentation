<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Vector\Add;

<<__EntryPoint>>
function basic_usage_main(): void {
  $v = Vector {};

  $v->add('red');
  \var_dump($v);

  // Vector::add returns the Vector so it can be chained
  $v->add('green')
    ->add('blue')
    ->add('yellow');
  \var_dump($v);
}
