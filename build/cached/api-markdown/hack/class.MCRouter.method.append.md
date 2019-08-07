``` yamlmeta
{
    "name": "append",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mcrouter/ext_mcrouter.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_mcrouter.hhi"
    ],
    "class": "MCRouter"
}
```




Modify a value







``` Hack
public function append(
  string $key,
  string $value,
): Awaitable<void>;
```




## Parameters




+ ` string $key ` - Name of the key to modify
+ ` string $value ` - String to append




## Returns




* ` Awaitable<void> `




## Examples




The following example shows how to use the ` MCRouter::append ` function.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.MCRouter/append/001-basic-usage.php @@
<!-- HHAPIDOC -->
