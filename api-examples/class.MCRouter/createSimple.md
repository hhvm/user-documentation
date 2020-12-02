The following example shows you how use `MCRouter::createSimple` to create an instance of `MCRouter`. You only need to pass it a `Vector` containing one or more locations of Memcached servers; default configurations are used after that (e.g, `route = 'PoolRoute|P'`).

```basic-usage.php
$servers = Vector {\getenv('HHVM_TEST_MCROUTER')};
$mc = \MCRouter::createSimple($servers);
\var_dump($mc is \MCRouter);
```.hhvm.expectf
bool(true)
```.example.hhvm.out
bool(true)
```.skipif
\Hack\UserDocumentation\API\Examples\MCRouter\skipif();
```
