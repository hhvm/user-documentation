<?hh // partial

namespace Hack\UserDocumentation\API\Examples\HH\Shapes\ToArray;

<<__EntryPoint>>
function run(): void {
  $point = shape('name' => 'Jane Doe', 'age' => 55, 'points' => 25.30);
  \var_dump(Shapes::toArray($point));
}
