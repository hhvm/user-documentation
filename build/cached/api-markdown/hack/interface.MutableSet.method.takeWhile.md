``` yamlmeta
{
    "name": "takeWhile",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableSet"
}
```




Returns a ` MutableSet ` containing the values of the current `` MutableSet ``
up to but not including the first value that produces ``` false ``` when passed
to the specified callback




``` Hack
public function takeWhile(
  callable $fn,
): MutableSet<Tv>;
```




The returned ` MutableSet ` will always be a proper subset of the current
`` MutableSet ``.




## Parameters




+ ` callable $fn ` - The callback that is used to determine the stopping condition.




## Returns




* ` MutableSet<Tv> ` - A `` MutableSet `` that is a proper subset of the current
  ``` MutableSet ``` up until the callback returns ```` false ````.
<!-- HHAPIDOC -->
