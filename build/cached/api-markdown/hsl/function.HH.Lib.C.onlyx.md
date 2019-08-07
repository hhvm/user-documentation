``` yamlmeta
{
    "name": "HH\\Lib\\C\\onlyx",
    "sources": [
        "api-sources/hsl/src/c/select.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns the first and only element of the given Traversable, or throws if the
Traversable is empty




``` Hack
namespace HH\Lib\C;

function onlyx<\T>(
  \  Traversable<\T> $traversable,
  ?\HH\Lib\Str\SprintfFormatString $format_string = NULL,
  \mixed ...$format_args,
): \T;
```




An optional format string (and format arguments) may be passed to specify
a custom message for the exception in the error case.




For Traversables with more than one element, see ` C\firstx `.




Time complexity: O(1)
Space complexity: O(1)




## Parameters




+ ` \ Traversable<\T> $traversable `
+ ` ?\HH\Lib\Str\SprintfFormatString $format_string = NULL `
+ ` \mixed ...$format_args `




## Returns




* ` \T `
<!-- HHAPIDOC -->
