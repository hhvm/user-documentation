<?php

namespace HHVM\UserDocumentation\Inconsistencies\Intro\Examples\LVP;

class Foo {
  function bar($baz) {
    $baz = 'herpderp';
    // Always outputs array('herpderp')
    var_dump(func_get_args());
  }
}

$f = new Foo();
$f->bar('blah');
