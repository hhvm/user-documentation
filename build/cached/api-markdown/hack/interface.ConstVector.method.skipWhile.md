``` yamlmeta
{
    "name": "skipWhile",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstVector"
}
```




Returns a ` ConstVector ` containing the values of the current `` ConstVector ``
starting after and including the first value that produces ``` true ``` when
passed to the specified callback




``` Hack
public function skipWhile(
  callable $fn,
): ConstVector<Tv>;
```




The returned ` ConstVector ` will always be a proper subset of the current
`` ConstVector ``.




## Parameters




+ ` callable $fn ` - The callback used to determine the starting element for the
  returned `` ConstVector ``.




## Returns




* ` ConstVector<Tv> ` - A `` ConstVector `` that is a proper subset of the current
  ``` ConstVector ``` starting after the callback returns ```` true ````.
<!-- HHAPIDOC -->
