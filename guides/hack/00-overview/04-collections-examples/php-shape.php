<?php

namespace Hack\UserDocumentation\Overview\Collections\Examples\PHPShape;

$my_shape = array('id' => null, 'url' => null, 'count' => 0);
$shape_a = $my_shape;
$shape_a['id'] = "573065673A34Y";
$shape_a['url'] = "http://facebook.com";

function foo($x) {
  echo $x['url'];
  // ...
}

foo($shape_a);
