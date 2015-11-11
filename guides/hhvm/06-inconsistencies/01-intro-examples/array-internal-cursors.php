<?php

namespace HHVM\UserDocumentation\Inconsistencies\Intro\Examples\AIC;

$x = [0, 1];
next($x); // internal array cursor points at 1
next($x); // internal array cursor points after the last element
$y = $x;
$y[] = 2; // Triggers copy-on-write

var_dump(current($x)); // bool(false)
var_dump(current($y)); // int(2) on HHVM, int(0) on PHP
