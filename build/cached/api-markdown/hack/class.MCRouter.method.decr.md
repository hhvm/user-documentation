``` yamlmeta
{
    "name": "decr",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mcrouter/ext_mcrouter.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_mcrouter.hhi"
    ],
    "class": "MCRouter"
}
```




Atomicly decrement a numeric value







``` Hack
public function decr(
  string $key,
  int $val,
): Awaitable<int>;
```




## Parameters




+ ` string $key ` - Name of the key to modify
+ ` int $val ` - Amount to decrement




## Returns




* ` int ` - - The new value




## Examples




The following example shows how to decrement a value of a key by a specified integer using ` MCRouter::incr `. The value **must** be numeric.




Note that you can't decrement below 0. So if your value is 1 and you try to decrement 3, the value you get back will be 0.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.MCRouter/decr/001-basic-usage.php @@
<!-- HHAPIDOC -->
