``` yamlmeta
{
    "name": "takeWhile",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstSet"
}
```




Returns a ` ConstSet ` containing the values of the current `` ConstSet `` up to
but not including the first value that produces ``` false ``` when passed to the
specified callback




``` Hack
public function takeWhile(
  callable $fn,
): ConstSet<Tv>;
```




The returned ` ConstSet ` will always be a proper subset of the current
`` ConstSet ``.




## Parameters




+ ` callable $fn ` - The callback that is used to determine the stopping condition.




## Returns




* ` ConstSet<Tv> ` - A `` ConstSet `` that is a proper subset of the current ``` ConstSet ```
  up until the callback returns ```` false ````.
<!-- HHAPIDOC -->
