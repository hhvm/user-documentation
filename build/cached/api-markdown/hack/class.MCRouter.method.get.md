``` yamlmeta
{
    "name": "get",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mcrouter/ext_mcrouter.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_mcrouter.hhi"
    ],
    "class": "MCRouter"
}
```




Retreive a value







``` Hack
public function get(
  string $key,
): Awaitable<string>;
```




## Parameters




+ ` string $key ` - Name of the key to retreive




## Returns




* ` string ` - - The Value stored




## Examples




Most of the ` MCRouter ` examples use `` MCRouter::get `` in order to demonstrate other functions of the API. This example calls out ``` get ``` explicitly in its own function to show you how it works. If you try to ```` get ```` on a key that does not exist, an exception will be thrown.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.MCRouter/get/001-basic-usage.php @@
<!-- HHAPIDOC -->
