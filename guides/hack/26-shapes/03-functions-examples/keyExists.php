<?hh

namespace Hack\UserDocumentation\Shapes\Functions\Examples\fKeyExists;

class C {
  const string KEYX = 'x';
  const string KEYY = 'y';
  const int KEYINTX = 10;
  const int KEYINTY = 23;
  const int KEYINTZ = 50;
}

function run(): void {
  echo "\n======== Shapes::keyExists ========\n\n";

  $s = shape('id' => "23456", 'url' => "www.example.com", 'count' => 23);

  $v = Shapes::keyExists($s, 'url');    // field exists, return true
  echo "keyExists(\$s, 'x') = " . $v ."\n";

  $v = Shapes::keyExists($s, 'name');   // does not exist, return false
  echo "keyExists(\$s, 'name') = " . $v ."\n";
}

run();
