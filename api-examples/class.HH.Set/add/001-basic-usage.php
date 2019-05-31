<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Set\Add;

$s = Set {};

$s->add('red');
var_dump($s);

// Set::add returns the Set so it can be chained
$s->add('green')
  ->add('blue')
  ->add('yellow');
var_dump($s);

// Adding an element that already exists in the Set has no effect
$s->add('green')
  ->add('blue')
  ->add('yellow');
var_dump($s);
