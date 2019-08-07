``` yamlmeta
{
    "name": "getErrors",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mcrouter/ext_mcrouter.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_mcrouter.hhi"
    ],
    "class": "MCRouterOptionException"
}
```




``` Hack
public function getErrors(): array<array<string>>;
```




## Returns




+ ` array<array<string>> `




## Examples




The following example shows you how to get the errors that are available when bad options are passed to the ` MCRouter ` constructor using `` MCRouterOptionException::getErrors ``







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.MCRouterOptionException/getErrors/001-basic-usage.php @@
<!-- HHAPIDOC -->
