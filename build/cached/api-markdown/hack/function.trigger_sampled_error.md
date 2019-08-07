``` yamlmeta
{
    "name": "trigger_sampled_error",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/std/ext_std_errorfunc.php"
    ]
}
```




``` Hack
function trigger_sampled_error(
  string $error_msg,
  int $sample_rate,
  int $error_type = E_USER_NOTICE,
): bool;
```




## Parameters




+ ` string $error_msg `
+ ` int $sample_rate `
+ ` int $error_type = E_USER_NOTICE `




## Returns




* ` bool `
<!-- HHAPIDOC -->
