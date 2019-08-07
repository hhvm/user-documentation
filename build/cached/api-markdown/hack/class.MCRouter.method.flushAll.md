``` yamlmeta
{
    "name": "flushAll",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mcrouter/ext_mcrouter.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_mcrouter.hhi"
    ],
    "class": "MCRouter"
}
```




Flush all key/value pairs







``` Hack
public function flushAll(
  int $delay = 0,
): Awaitable<void>;
```




## Parameters




+ ` int $delay = 0 ` - Amount of time to delay before flush




## Returns




* ` Awaitable<void> `




## Examples




The following example shows how to use ` MCRouter::flushAll ` to basically flush out the memcached server of all keys and values.




It is **imperative** to note that you must manually construct the ` MCRouter ` instance passing `` 'enable_flush_cmd' => true `` as one of your options; otherwise a command disabled exception will be thrown. In other words, you cannot use ``` MCRouter::createSimple() ``` when using ```` flushAll ````.




You can add an optional delay time in seconds to your call to ` flushAll ` as well.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.MCRouter/flushAll/001-basic-usage.php @@
<!-- HHAPIDOC -->
