``` yamlmeta
{
    "name": "takeWhile",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Returns a ` Map ` containing the keys and values of the current `` Map `` up to
but not including the first value that produces ``` false ``` when passed to the
specified callback




``` Hack
public function takeWhile(
  callable $callback,
): HH\Map<Tk, Tv>;
```




The returned ` Map ` will always be a proper subset of the current `` Map ``.




## Parameters




+ ` callable $callback `




## Returns




* ` HH\Map<Tk, Tv> ` - A `` Map `` that is a proper subset of the current ``` Map ``` up until
  the callback returns ```` false ````.
<!-- HHAPIDOC -->
