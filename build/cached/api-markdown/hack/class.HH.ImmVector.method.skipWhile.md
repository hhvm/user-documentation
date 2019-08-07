``` yamlmeta
{
    "name": "skipWhile",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmVector.hhi"
    ],
    "class": "HH\\ImmVector"
}
```




Returns an ` ImmVector ` containing the values of the current `` ImmVector ``
starting after and including the first value that produces ``` false ``` when
passed to the specified callback




``` Hack
public function skipWhile(
  callable $fn,
): ImmVector<Tv>;
```




That is, skips the continuous prefix of
values in the current ` ImmVector ` for which the specified callback returns
`` true ``.




The returned ` ImmVector ` will always be a subset (but not necessarily a
proper subset) of the current `` ImmVector ``.




## Parameters




+ ` callable $fn ` - The callback used to determine the starting element for the
  returned `` ImmVector ``.




## Returns




* ` ImmVector<Tv> ` - An `` ImmVector `` that is a subset of the current ``` ImmVector ```
  starting with the value for which the callback first returns
  ```` false ````.




## Examples




See [` Vector::skipWhile `](</hack/reference/class/Vector/skipWhile/#examples>) for usage examples.
<!-- HHAPIDOC -->
