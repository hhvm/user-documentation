``` yamlmeta
{
    "name": "clock_gettime",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/std/ext_std_options.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_options.hhi"
    ]
}
```




``` Hack
function clock_gettime(
  int $clk_id,
  mixed &$sec,
  mixed &$nsec,
): bool;
```




## Parameters




+ ` int $clk_id `
+ ` mixed &$sec `
+ ` mixed &$nsec `




## Returns




* ` bool `
<!-- HHAPIDOC -->
