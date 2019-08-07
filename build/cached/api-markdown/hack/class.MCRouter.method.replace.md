``` yamlmeta
{
    "name": "replace",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mcrouter/ext_mcrouter.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_mcrouter.hhi"
    ],
    "class": "MCRouter"
}
```




Store a value







``` Hack
public function replace(
  string $key,
  string $value,
  int $flags = 0,
  int $expiration = 0,
): Awaitable<void>;
```




## Parameters




+ ` string $key ` - Name of the key to store
+ ` string $value ` - Datum to store
+ ` int $flags = 0 `
+ ` int $expiration = 0 `




## Returns




* ` Awaitable<void> `




## Examples




The following example shows how to use ` MCRouter::replace ` to replace a key/value pair in the memcached server. You can only call `` replace `` on a currently existing key (e.g., one that has been added via ``` MCRouter::add ``` or ```` MCRouter::set ````). In many cases a call to ````` set/set ````` is the same as a call to `````` add/replace ``````, accomplishing the same thing.




If you pass an expiration time for the key, that is in seconds.




And these are the bitwise or style flags that can be passed to ` replace `:




```
MC_MSG_FLAG_PHP_SERIALIZED = 0x1,
MC_MSG_FLAG_COMPRESSED = 0x2,
MC_MSG_FLAG_FB_SERIALIZED = 0x4,
MC_MSG_FLAG_FB_COMPACT_SERIALIZED = 0x8,
MC_MSG_FLAG_ASCII_INT_SERIALIZED = 0x10,
MC_MSG_FLAG_NZLIB_COMPRESSED = 0x800,
MC_MSG_FLAG_QUICKLZ_COMPRESSED = 0x2000,
MC_MSG_FLAG_SNAPPY_COMPRESSED = 0x4000,
MC_MSG_FLAG_BIG_VALUE = 0X8000,
MC_MSG_FLAG_NEGATIVE_CACHE = 0x10000,
MC_MSG_FLAG_HOT_KEY = 0x20000,
```




See the [header file with the flags](<https://github.com/facebook/mcrouter/blob/5f259ed47b52f86cad750d2343edf324e80cb397/mcrouter/lib/mc/msg.h>)







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.MCRouter/replace/001-basic-usage.php @@
<!-- HHAPIDOC -->
