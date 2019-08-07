``` yamlmeta
{
    "name": "__construct",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mcrouter/ext_mcrouter.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_mcrouter.hhi"
    ],
    "class": "MCRouterOptionException"
}
```




``` Hack
public function __construct(
  array<array<string>> $errors,
);
```




## Parameters




+ ` array<array<string>> $errors `




## Examples




You normally will catch a ` MCRouterOptionException ` over constructing one explicitly, but it can be done. Here is an example where you can check the options and throw the exception with a custom error if you don't have good options.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.MCRouterOptionException/__construct/001-basic-usage.php @@
<!-- HHAPIDOC -->
