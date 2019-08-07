``` yamlmeta
{
    "name": "takeWhile",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmVector.hhi"
    ],
    "class": "HH\\ImmVector"
}
```




Returns an ` ImmVector ` containing the values of the current `` ImmVector `` up
to but not including the first value that produces ``` false ``` when passed to
the specified callback




``` Hack
public function takeWhile(
  callable $callback,
): ImmVector<Tv>;
```




That is, takes the continuous prefix of values in
the current ` ImmVector ` for which the specified callback returns `` true ``.




The returned ` ImmVector ` will always be a subset (but not necessarily a
proper subset) of the current `` ImmVector ``.




## Parameters




+ ` callable $callback `




## Returns




* ` ImmVector<Tv> ` - An `` ImmVector `` that is a subset of the current ``` ImmVector ``` up
  until when the callback returns ```` false ````.




## Examples




See [` Vector::takeWhile `](</hack/reference/class/Vector/takeWhile/#examples>) for usage examples.
<!-- HHAPIDOC -->
