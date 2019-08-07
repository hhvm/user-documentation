``` yamlmeta
{
    "name": "takeWhile",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/KeyedIterable.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\KeyedIterable"
}
```




Returns a ` KeyedIterable ` containing the values of the current
`` KeyedIterable `` up to but not including the first value that produces
``` false ``` when passed to the specified callback




``` Hack
public function takeWhile(
  callable $fn,
): KeyedIterable<Tk, Tv>;
```




The returned ` KeyedIterable ` will always be a proper subset of the current
`` KeyedIterable ``.




## Parameters




+ ` callable $fn ` - The callback that is used to determine the stopping
  condition.




## Returns




* ` KeyedIterable<Tk, Tv> ` - A `` KeyedIterable `` that is a proper subset of the current
  ``` KeyedIterable ``` up until the callback returns ```` false ````.
<!-- HHAPIDOC -->
