<?hh

namespace Hack\UserDocumentation\API\Examples\HH\Shapes\ToArray;

function run(): void {
  $point = shape('name' => 'Jane Doe', 'age' => 55, 'points' => 25.30);
  var_dump(Shapes::toArray($point));
}

run();
