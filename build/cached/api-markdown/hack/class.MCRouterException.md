``` yamlmeta
{
    "name": "MCRouterException",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mcrouter/ext_mcrouter.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_mcrouter.hhi"
    ],
    "class": "MCRouterException"
}
```




Any failed MCRouter action will throw an
instance of MCRouterException




## Interface Synopsis




``` Hack
class MCRouterException extends Exception {...}
```




### Public Methods




+ [` ->__construct(string $message, int $op = MCRouter::mc_op_unknown, int $reply = MCRouter::mc_res_unknown, string $key = '') `](</hack/reference/class/MCRouterException/__construct/>)
+ [` ->getKey(): string `](</hack/reference/class/MCRouterException/getKey/>)
+ [` ->getOp(): int `](</hack/reference/class/MCRouterException/getOp/>)
<!-- HHAPIDOC -->
