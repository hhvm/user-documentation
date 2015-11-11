<?hh

namespace Hack\UserDocumentation\Shapes\Functions\Examples\fToArray;

class C {
  const string KEYX = 'x';
  const string KEYY = 'y';
  const int KEYINTX = 10;
  const int KEYINTY = 23;
  const int KEYINTZ = 50;
}

function run(): void {
  echo "\n======== Shapes::toArray ========\n\n";

  $s = shape();
  $a = Shapes::toArray($s);   // returns an array of 0 elements
  echo "# elements in array = " . count($a) . "\n";
  var_dump($s, $a);
  echo "----------------------------\n";

  $s = shape('x' => 10, 'y' => 20);
  $a = Shapes::toArray($s);
  echo "# elements in array = " . count($a) . "\n";
  var_dump($s, $a);
  echo "----------------------------\n";

  $s = shape('y' => 20, 'x' => 10);
  $a = Shapes::toArray($s);
  echo "# elements in array = " . count($a) . "\n";
  var_dump($s, $a);
  echo "----------------------------\n";

  $s = shape('id' => "23456", 'url' => "www.example.com", 'count' => 23);
  // returns an array of 3 elements, of type string, string, and int, respectively
  $a = Shapes::toArray($s);
  echo "# elements in array = " . count($a) . "\n";
}

run();
