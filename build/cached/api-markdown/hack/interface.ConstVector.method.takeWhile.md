``` yamlmeta
{
    "name": "takeWhile",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstVector"
}
```




Returns a ` ConstVector ` containing the values of the current `` ConstVector ``
up to but not including the first value that produces ``` false ``` when passed
to the specified callback




``` Hack
public function takeWhile(
  callable $fn,
): ConstVector<Tv>;
```




The returned ` ConstVector ` will always be a proper subset of the current
`` ConstVector ``.




## Parameters




+ ` callable $fn ` - The callback that is used to determine the stopping
  condition.




## Returns




* ` ConstVector<Tv> ` - A `` ConstVector `` that is a proper subset of the current
  ``` ConstVector ``` up until the callback returns ```` false ````.
<!-- HHAPIDOC -->
