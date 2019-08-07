``` yamlmeta
{
    "name": "HH\\int_mul_add_overflow",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/fb/ext_fb.php"
    ]
}
```




``` Hack
namespace HH;

function int_mul_add_overflow(
  int $a,
  int $b,
  int $bias,
): int;
```




## Parameters




+ ` int $a `
+ ` int $b `
+ ` int $bias `




## Returns




* ` int `
<!-- HHAPIDOC -->
