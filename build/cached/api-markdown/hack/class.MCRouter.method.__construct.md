``` yamlmeta
{
    "name": "__construct",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mcrouter/ext_mcrouter.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_mcrouter.hhi"
    ],
    "class": "MCRouter"
}
```




Initialize an MCRouter handle




``` Hack
public function __construct(
  array<string, mixed> $options,
  string $pid = '',
): void;
```




See: https://github.com/facebook/mcrouter/wiki
See: https://github.com/facebook/mcrouter/blob/master/
mcrouter/mcrouter_options_list.h




## Parameters




+ ` array<string, mixed> $options `
+ ` string $pid = '' `




## Returns




* ` void `




## Examples




The following example shows you how to explicitly create an instance of ` MCRouter ` using `` new ``, by definition, its constructor. You must create a configuration string (or provide a configuration file that contains appropriate configuration information), and, optionally, a persistence identifier can bet passed as the second parameter to the constructor.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.MCRouter/__construct/001-basic-usage.php @@
<!-- HHAPIDOC -->
