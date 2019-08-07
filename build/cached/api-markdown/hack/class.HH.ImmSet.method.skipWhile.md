``` yamlmeta
{
    "name": "skipWhile",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Returns an ` ImmSet ` containing the values of the current `` ImmSet `` starting
after and including the first value that produces ``` true ``` when passed to
the specified callback




``` Hack
public function skipWhile(
  callable $fn,
): ImmSet<Tv>;
```




The returned ` ImmSet ` will always be a proper subset of the current
`` ImmSet ``.




## Parameters




+ ` callable $fn ` - The callback used to determine the starting element for the
  `` ImmSet ``.




## Returns




* ` ImmSet<Tv> ` - An `` ImmSet `` that is a proper subset of the current ``` ImmSet ```
  starting after the callback returns ```` true ````.




## Examples




See [` Set::skipWhile `](</hack/reference/class/Set/skipWhile/#examples>) for usage examples.
<!-- HHAPIDOC -->
