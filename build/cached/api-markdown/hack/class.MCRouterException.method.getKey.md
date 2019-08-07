``` yamlmeta
{
    "name": "getKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mcrouter/ext_mcrouter.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_mcrouter.hhi"
    ],
    "class": "MCRouterException"
}
```




``` Hack
public function getKey(): string;
```




## Returns




+ ` string `




## Examples




The following example shows how to retrieve the key from an ` MCRouterException ` using its `` getKey `` method. If there is no key associated with the exception, then ``` "" ``` will be returned.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.MCRouterException/getKey/001-basic-usage.php @@
<!-- HHAPIDOC -->
