``` yamlmeta
{
    "name": "skipWhile",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Returns a ` Map ` containing the values of the current `` Map `` starting after
and including the first value that produces ``` true ``` when passed to the
specified callback




``` Hack
public function skipWhile(
  callable $fn,
): Map<Tk, Tv>;
```




The returned ` Map ` will always be a proper subset of this `` Map ``.




## Parameters




+ ` callable $fn ` - The callback used to determine the starting element for the
  current `` Map ``.




## Returns




* ` Map<Tk, Tv> ` - A `` Map `` that is a proper subset of the current ``` Map ``` starting
  after the callback returns ```` true ````.
<!-- HHAPIDOC -->
