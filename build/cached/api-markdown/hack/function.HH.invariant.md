``` yamlmeta
{
    "name": "HH\\invariant",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/invariant.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/func_pointers.hhi"
    ]
}
```




Ensure that an invariant is satisfied




``` Hack
namespace HH;

function invariant(
  \mixed $condition,
  \  FormatString<\PlainSprintf> ...$args,
): \void;
```




If it fails, it calls
` invariant_violation `




This function provides a way to have a variable type checked as a more
specific type than it is currently declared. A source transformation in the
runtime modifies code that looks like:




```
invariant(<condition>, 'sprintf format: %s %d', 'string', ...);
```

... is transformed to be:




```
  if (!(<condition>)) { // an Exception is thrown
    invariant_violation('sprintf format: %s', 'string', ...);
  }
  // <condition> is known to be true in the code below
```




See also:

+ [` invariant ` guide](</hack/types/refining#invariant>)




## Parameters




* ` \mixed $condition `
* ` \ FormatString<\PlainSprintf> ...$args ` - Arguments supplied if the condition is not met. This is
  usually a string, with possible placeholders.




## Returns




- ` \void `
<!-- HHAPIDOC -->
