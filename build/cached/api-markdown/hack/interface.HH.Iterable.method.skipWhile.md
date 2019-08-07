``` yamlmeta
{
    "name": "skipWhile",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/IteratorAggregate.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\Iterable"
}
```




Returns an ` Iterable ` containing the values of the current `` Iterable ``
starting after and including the first value that produces ``` true ``` when
passed to the specified callback




``` Hack
public function skipWhile(
  callable $fn,
): Iterable<Tv>;
```




The returned ` Iterable ` will always be a proper subset of the current
`` Iterable ``.




## Parameters




+ ` callable $fn ` - The callback used to determine the starting element for the
  returned `` Iterable ``.




## Returns




* ` Iterable<Tv> ` - An `` Iterable `` that is a proper subset of the current ``` Iterable ```
  starting after the callback returns ```` true ````.
<!-- HHAPIDOC -->
