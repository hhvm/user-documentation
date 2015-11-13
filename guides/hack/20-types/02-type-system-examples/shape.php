<?hh

namespace Hack\UserDocumentation\Types\TypeSystem\Examples\Shp;

type customer = shape('id' => int, 'name' => string);

function create_user(int $id, string $name): customer {
  return shape('id' => $id, 'name' => $name);
}

function ts_shape(): void {
  $c = create_user(0, "James");
  var_dump($c['id']);
  var_dump($c['name']);
}

ts_shape();
