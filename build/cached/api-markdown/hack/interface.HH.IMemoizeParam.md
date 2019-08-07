``` yamlmeta
{
    "name": "HH\\IMemoizeParam",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/hh/ext_hh.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\IMemoizeParam"
}
```




Classes that implement IMemoizeParam may be used as parameters on
<<__Memoize>> functions







## Interface Synopsis




``` Hack
namespace HH;

interface IMemoizeParam {...}
```




### Public Methods




+ [` ->getInstanceKey(): string `](</hack/reference/interface/HH.IMemoizeParam/getInstanceKey/>)\
  Serialize this object to a string that can be used as a
  dictionary key to differentiate instances of this class
<!-- HHAPIDOC -->
