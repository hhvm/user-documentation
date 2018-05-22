<?hh

namespace Hack\UserDocumentation\Overview\Collections\Examples\HackShape;

type MyShape = shape('id' => string, 'url' => string, 'count' => int);
$shape_a = shape(
  'id' => "573065673A34Y", 
  'url' => "http://facebook.com", 
  'count' => 0
);

function foo(MyShape $x): void {
  echo $x['url'];
  // ...
}

foo($shape_a);
