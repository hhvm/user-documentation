``` yamlmeta
{
    "name": "icu_match",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/icu/ext_icu.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_icu.hhi"
    ]
}
```




``` Hack
function icu_match(
  string $pattern,
  string $subject,
  mixed &$matches = NULL,
  int $flags = 0,
): mixed;
```




## Parameters




+ ` string $pattern `
+ ` string $subject `
+ ` mixed &$matches = NULL `
+ ` int $flags = 0 `




## Returns




* ` mixed `
<!-- HHAPIDOC -->
