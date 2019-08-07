``` yamlmeta
{
    "name": "__construct",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mcrouter/ext_mcrouter.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_mcrouter.hhi"
    ],
    "class": "MCRouterException"
}
```




``` Hack
public function __construct(
  string $message,
  int $op = MCRouter::mc_op_unknown,
  int $reply = MCRouter::mc_res_unknown,
  string $key = '',
);
```




## Parameters




+ ` string $message `
+ ` int $op = MCRouter::mc_op_unknown `
+ ` int $reply = MCRouter::mc_res_unknown `
+ ` string $key = '' `




## Examples




You normally will catch a ` MCRouterException ` over constructing one explicitly, but it can be done. Here is an example where you can check the version of the memcached server and throw if you don't have the right one.










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.MCRouterException/__construct/001-basic-usage.php @@
<!-- HHAPIDOC -->
