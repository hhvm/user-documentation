``` yamlmeta
{
    "name": "HH\\invariant_violation",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/invariant.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/printf.hhi"
    ]
}
```




Call this when one of your ` invariant `s has been violated




``` Hack
namespace HH;

function invariant_violation(
  \FormatString<\PlainSprintf> $format_str,
  ...$fmt_args,
): \noreturn;
```




It calls the
function you registered with ` invariant_callback_register ` and then throws
an `` InvariantException ``




## Parameters




+ ` \FormatString<\PlainSprintf> $format_str ` - The string that will be displayed when your invariant
  fails.
+ ` ...$fmt_args `




## Returns




* ` \noreturn `
<!-- HHAPIDOC -->
