``` yamlmeta
{
    "name": "fb_setprofile",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/xhprof/ext_xhprof.php"
    ]
}
```




``` Hack
function fb_setprofile(
  mixed $callback,
  int $flags = SETPROFILE_FLAGS_DEFAULT,
  vec<string> $functions = vec [
],
): void;
```




## Parameters




+ ` mixed $callback `
+ ` int $flags = SETPROFILE_FLAGS_DEFAULT `
+ ` vec<string> $functions = vec [ ] `




## Returns




* ` void `
<!-- HHAPIDOC -->
