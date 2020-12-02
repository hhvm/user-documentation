The following example shows you how to get the errors that are available when bad options are passed to the `MCRouter` constructor using `MCRouterOptionException::getErrors`

```basic-usage.php
$servers = Vector {\getenv('HHVM_TEST_MCROUTER')};
// For many use cases, calling MCRouter::createSimple($servers) would
// suffice here. But this shows you how to explicitly create the configuration
// options for creating an instance of MCRouter

// This has a bad option setup
$options = darray['asynclog_disable' => 'purple'];

$mc = null;

try {
  $mc = new \MCRouter($options);
} catch (\MCRouterOptionException $ex) {
  \var_dump($ex->getErrors());
}
```.hhvm.expectf
varray(1) {
  darray(3) {
    ["option"]=>
    string(16) "asynclog_disable"
    ["value"]=>
    string(6) "purple"
    ["error"]=>
    string(%d) "couldn't convert value to integer. Exception: %s
  }
}
```.example.hhvm.out
varray(1) {
  darray(3) {
    ["option"]=>
    string(16) "asynclog_disable"
    ["value"]=>
    string(6) "purple"
    ["error"]=>
    string(78) "couldn't convert value to integer. Exception: Invalid value for bool: "purple""
  }
}
```.skipif
\Hack\UserDocumentation\API\Examples\MCRouter\skipif();
```
