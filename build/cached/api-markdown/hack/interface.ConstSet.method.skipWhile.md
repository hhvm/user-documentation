``` yamlmeta
{
    "name": "skipWhile",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstSet"
}
```




Returns a ` ConstSet ` containing the values of the current `` ConstSet ``
starting after and including the first value that produces ``` true ``` when
passed to the specified callback




``` Hack
public function skipWhile(
  callable $fn,
): ConstSet<Tv>;
```




The returned ` ConstSet ` will always be a proper subset of the current
`` ConstSet ``.




## Parameters




+ ` callable $fn ` - The callback used to determine the starting element for the
  `` ConstSet ``.




## Returns




* ` ConstSet<Tv> ` - A `` ConstSet `` that is a proper subset of the current ``` ConstSet ```
  starting after the callback returns ```` true ````.
<!-- HHAPIDOC -->
