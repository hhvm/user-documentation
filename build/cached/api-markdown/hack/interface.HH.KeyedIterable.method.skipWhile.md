``` yamlmeta
{
    "name": "skipWhile",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/KeyedIterable.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\KeyedIterable"
}
```




Returns a ` KeyedIterable ` containing the values of the current
`` KeyedIterable `` starting after and including the first value that produces
``` true ``` when passed to the specified callback




``` Hack
public function skipWhile(
  callable $fn,
): KeyedIterable<Tk, Tv>;
```




The returned ` KeyedIterable ` will always be a proper subset of the current
`` KeyedIterable ``.




## Parameters




+ ` callable $fn ` - The callback used to determine the starting element for the
  returned `` KeyedIterable ``.




## Returns




* ` KeyedIterable<Tk, Tv> ` - A `` KeyedIterable `` that is a proper subset of the current
  ``` KeyedIterable ``` starting after the callback returns ```` true ````.
<!-- HHAPIDOC -->
