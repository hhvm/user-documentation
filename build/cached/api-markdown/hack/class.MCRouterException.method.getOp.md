``` yamlmeta
{
    "name": "getOp",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mcrouter/ext_mcrouter.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_mcrouter.hhi"
    ],
    "class": "MCRouterException"
}
```




``` Hack
public function getOp(): int;
```




## Returns




+ ` int `




## Examples




The following example shows how to retrieve the memcached operation from an ` MCRouterException ` using its `` getOp `` method. Then we get its friendly name via ``` MCRouter::getOpName() ```.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.MCRouterException/getOp/001-basic-usage.php @@
<!-- HHAPIDOC -->
