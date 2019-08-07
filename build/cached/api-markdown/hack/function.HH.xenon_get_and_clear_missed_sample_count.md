``` yamlmeta
{
    "name": "HH\\xenon_get_and_clear_missed_sample_count",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/xenon/ext_xenon.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_xenon.hhi"
    ]
}
```




Returns the number of xenon samples lost so far




``` Hack
namespace HH;

function xenon_get_and_clear_missed_sample_count(): int;
```




## Returns




+ ` int `
<!-- HHAPIDOC -->
