``` yamlmeta
{
    "name": "takeWhile",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/IteratorAggregate.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\Iterable"
}
```




Returns an ` Iterable ` containing the values of the current `` Iterable `` up
to but not including the first value that produces ``` false ``` when passed to
the specified callback




``` Hack
public function takeWhile(
  callable $fn,
): Iterable<Tv>;
```




The returned ` Iterable ` will always be a proper subset of the current
`` Iterable ``.




## Parameters




+ ` callable $fn ` - The callback that is used to determine the stopping
  condition.




## Returns




* ` Iterable<Tv> ` - An `` Iterable `` that is a proper subset of the current ``` Iterable ```
  up until the callback returns ```` false ````.
<!-- HHAPIDOC -->
