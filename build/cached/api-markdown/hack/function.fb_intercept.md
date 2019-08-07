``` yamlmeta
{
    "name": "fb_intercept",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/fb/ext_fb.php"
    ]
}
```




``` Hack
function fb_intercept(
  string $name,
  mixed $handler,
  mixed $data = NULL,
): bool;
```




## Parameters




+ ` string $name `
+ ` mixed $handler `
+ ` mixed $data = NULL `




## Returns




* ` bool `
<!-- HHAPIDOC -->
