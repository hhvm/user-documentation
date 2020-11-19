<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Vector\AddAll;

<<__EntryPoint>>
function basic_usage_main(): void {
  $v = Vector {};

  // Add all the values in a Set
  $v->addAll(Set {'a', 'b'});

  // Add all the values in a Vector
  $v->addAll(Vector {'c', 'd'});

  // Add all the values in a Map
  $v->addAll(Map {'foo' => 'e', 'bar' => 'f'});

  // Add all the values in an array
  $v->addAll(varray['g', 'h']);

  // Vector::addAll returns the Vector so it can be chained
  $v->addAll(ImmSet {'i', 'j'})
    ->addAll(ImmVector {'k', 'l'});

  \var_dump($v);
}
