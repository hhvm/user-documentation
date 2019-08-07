``` yamlmeta
{
    "name": "skipWhile",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableVector"
}
```




Returns a ` MutableVector ` containing the values of the current
`` MutableVector `` starting after and including the first value that produces
``` true ``` when passed to the specified callback




``` Hack
public function skipWhile(
  callable $fn,
): MutableVector<Tv>;
```




The returned ` MutableVector ` will always be a proper subset of the current
`` MutableVector ``.




## Parameters




+ ` callable $fn ` - The callback used to determine the starting element for the
  returned `` MutableVector ``.




## Returns




* ` MutableVector<Tv> ` - A `` MutableVector `` that is a proper subset of the current
  ``` MutableVector ``` starting after the callback returns ```` true ````.
<!-- HHAPIDOC -->
