<?hh

namespace Hack\UserDocumentation\Shapes\Functions\Examples\fRemoveKey;

class C {
  const string KEYX = 'x';
  const string KEYY = 'y';
  const int KEYINTX = 10;
  const int KEYINTY = 23;
  const int KEYINTZ = 50;
}

function run(): void {
  echo "\n======== Shapes::removeKey ========\n\n";

  $s = shape();
  \var_dump($s);
  Shapes::removeKey(&$s, 'name');  // no such field, so request ignored
  $a = Shapes::toArray($s);
  echo "# elements in array = " . \count($a) . "\n";
  \var_dump($s, $a);
  echo "----------------------------\n";

  $s = shape('x' => 10, 'y' => 20);
  \var_dump($s);
  Shapes::removeKey(&$s, C::KEYX); // field 'x' removed
  $a = Shapes::toArray($s);
  echo "# elements in array = " . \count($a) . "\n";
  \var_dump($s, $a);
  echo "----------------------------\n";

  $s = shape('id' => "23456", 'url' => "www.example.com", 'count' => 23);
  \var_dump($s);
  Shapes::removeKey(&$s, 'url');   // field 'url' removed
  $a = Shapes::toArray($s);
  echo "# elements in array = " . \count($a) . "\n";
  \var_dump($s, $a);
}

run();
