``` yamlmeta
{
    "name": "HH\\xenon_get_and_clear_samples",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/xenon/ext_xenon.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_xenon.hhi"
    ]
}
```




TODO: this will replace xenon_get_data()
this function is same as xenon_get_data() except that it deletes the stack
traces that are returned




``` Hack
namespace HH;

function xenon_get_and_clear_samples(): \varray<XenonSample>;
```




## Returns




+ ` \varray<XenonSample> `
<!-- HHAPIDOC -->
