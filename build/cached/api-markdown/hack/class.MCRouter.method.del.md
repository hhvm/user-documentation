``` yamlmeta
{
    "name": "del",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mcrouter/ext_mcrouter.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_mcrouter.hhi"
    ],
    "class": "MCRouter"
}
```




Delete a key







``` Hack
public function del(
  string $key,
): Awaitable<void>;
```




## Parameters




+ ` string $key ` - Key to delete




## Returns




* ` Awaitable<void> `




## Examples




The following example uses ` MCRouter::del ` to delete a key from the memcached server. Once the key is deleted, it is no longer accessible. Nor can you delete a non-existing key.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.MCRouter/del/001-basic-usage.php @@
<!-- HHAPIDOC -->
