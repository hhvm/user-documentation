``` yamlmeta
{
    "name": "skipWhile",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableSet"
}
```




Returns a ` MutableSet ` containing the values of the current `` MutableSet ``
starting after and including the first value that produces ``` true ``` when
passed to the specified callback




``` Hack
public function skipWhile(
  callable $fn,
): MutableSet<Tv>;
```




The returned ` MutableSet ` will always be a proper subset of the current
`` MutableSet ``.




## Parameters




+ ` callable $fn ` - The callback used to determine the starting element for the
  `` MutableSet ``.




## Returns




* ` MutableSet<Tv> ` - A `` MutableSet `` that is a proper subset of the current
  ``` MutableSet ``` starting after the callback returns ```` true ````.
<!-- HHAPIDOC -->
