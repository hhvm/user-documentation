``` yamlmeta
{
    "name": "version",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mcrouter/ext_mcrouter.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_mcrouter.hhi"
    ],
    "class": "MCRouter"
}
```




Get the remote server's current version







``` Hack
public function version(): Awaitable<string>;
```




## Returns




+ ` string ` - - The remote version




## Examples




The following example allows you to use ` MCRouter::version ` to get the version information of the memcached server you are connected to.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.MCRouter/version/001-basic-usage.php @@
<!-- HHAPIDOC -->
