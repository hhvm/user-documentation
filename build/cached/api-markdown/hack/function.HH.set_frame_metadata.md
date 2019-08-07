``` yamlmeta
{
    "name": "HH\\set_frame_metadata",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/hh/ext_hh.php",
        "api-sources/hhvm/hphp/hack/hhi/functions.hhi"
    ]
}
```




Attach metadata to the caller's stack frame




``` Hack
namespace HH;

function set_frame_metadata(
  \mixed $metadata,
): \void;
```




The metadata can be retrieved
using debug_backtrace(DEBUG_BACKTRACE_PROVIDE_METADATA).




## Parameters




+ ` \mixed $metadata `




## Returns




* ` \void `
<!-- HHAPIDOC -->
