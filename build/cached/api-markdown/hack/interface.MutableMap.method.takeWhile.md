``` yamlmeta
{
    "name": "takeWhile",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableMap"
}
```




Returns a ` MutableMap ` containing the keys and values of the current
`` MutableMap `` up to but not including the first value that produces ``` false ```
when passed to the specified callback




``` Hack
public function takeWhile(
  callable $fn,
): MutableMap<Tk, Tv>;
```




The returned ` MutableMap ` will always be a proper subset of the current
`` MutableMap ``.




## Parameters




+ ` callable $fn ` - The callback that is used to determine the stopping condition.




## Returns




* ` MutableMap<Tk, Tv> ` - A `` MutableMap `` that is a proper subset of the current
  ``` MutableMap ``` up until the callback returns ```` false ````.
<!-- HHAPIDOC -->
