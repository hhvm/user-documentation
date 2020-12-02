The following example shows you how to explicitly create an instance of `MCRouter` using `new`, by definition, its constructor. You must create a configuration string (or provide a configuration file that contains appropriate configuration information), and, optionally, a persistence identifier can bet passed as the second parameter to the constructor.

```basic-usage.php
$servers = Vector {\getenv('HHVM_TEST_MCROUTER')};
// For many use cases, calling MCRouter::createSimple($servers) would
// suffice here. But this shows you how to explicitly create the configuration
// options for creating an instance of MCRouter
$options = darray[
  'config_str' => \json_encode(
    darray[
      'pools' => darray[
        'P' => darray[
          'servers' => $servers,
        ],
      ],
      'route' => 'PoolRoute|P',
    ],
  ),
];
$mc = new \MCRouter($options); // could also pass a persistence id string here
\var_dump($mc is \MCRouter);
```.hhvm.expectf
bool(true)
```.example.hhvm.out
bool(true)
```.skipif
\Hack\UserDocumentation\API\Examples\MCRouter\skipif();
```
