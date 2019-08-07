``` yamlmeta
{
    "name": "skipWhile",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmMap.hhi"
    ],
    "class": "HH\\ImmMap"
}
```




Returns an ` ImmMap ` containing the values of the current `` ImmMap `` starting
after and including the first value that produces ``` true ``` when passed to
the specified callback




``` Hack
public function skipWhile(
  callable $fn,
): ImmMap<Tk, Tv>;
```




The returned ` ImmMap ` will always be a proper subset of the current
`` ImmMap ``.




## Parameters




+ ` callable $fn ` - The callback used to determine the starting element for the
  `` ImmMap ``.




## Returns




* ` ImmMap<Tk, Tv> ` - An `` ImmMap `` that is a proper subset of the current ``` ImmMap ```
  starting after the callback returns ```` true ````.




## Examples




See [` Map::skipWhile `](</hack/reference/class/Map/skipWhile/#examples>) for usage examples.
<!-- HHAPIDOC -->
