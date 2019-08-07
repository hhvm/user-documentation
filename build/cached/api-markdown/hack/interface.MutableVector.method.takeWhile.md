``` yamlmeta
{
    "name": "takeWhile",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableVector"
}
```




Returns a ` MutableVector ` containing the values of the current
`` MutableVector `` up to but not including the first value that produces
``` false ``` when passed to the specified callback




``` Hack
public function takeWhile(
  callable $fn,
): MutableVector<Tv>;
```




The returned ` MutableVector ` will always be a proper subset of the current
`` MutableVector ``.




## Parameters




+ ` callable $fn ` - The callback that is used to determine the stopping
  condition.




## Returns




* ` MutableVector<Tv> ` - A `` MutableVector `` that is a proper subset of the current
  ``` MutableVector ``` up until the callback returns ```` false ````.
<!-- HHAPIDOC -->
