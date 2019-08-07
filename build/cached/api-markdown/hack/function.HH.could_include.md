``` yamlmeta
{
    "name": "HH\\could_include",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/hh/ext_hh.php",
        "api-sources/hhvm/hphp/hack/hhi/functions.hhi"
    ]
}
```




Returns whether the (php) file could be included (eg if its been compiled
into the binary)




``` Hack
namespace HH;

function could_include(
  string $file,
): bool;
```




This is useful when you don't have a filesystem
(RepoAuthoritative mode) but still want to know if including a file will
work.




## Parameters




+ ` string $file `




## Returns




* ` bool `
<!-- HHAPIDOC -->
