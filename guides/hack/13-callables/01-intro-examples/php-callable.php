<?php

namespace Hack\UserDocumentation\Callables\Intro\Examples\PHPCallable;

function callMe(callable $callback) {
  $callback();
}

function run() {
  $callback = function () {
    echo "Hello!";
  };
  callMe($callback);
}

run();
