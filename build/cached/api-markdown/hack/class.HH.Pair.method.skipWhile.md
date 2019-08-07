``` yamlmeta
{
    "name": "skipWhile",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-pair.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Pair.hhi"
    ],
    "class": "HH\\Pair"
}
```




Returns an ` ImmVector ` containing the values of the current `` Pair `` starting
after and including the first value that produces ``` true ``` when passed to
the specified callback




``` Hack
public function skipWhile(
  callable $callback,
):     ImmVector<mixed>;
```




## Parameters




+ ` callable $callback ` - The callback used to determine the starting element for
  the `` ImmVector ``.




## Returns




* ` ImmVector<mixed> ` - An `` ImmVector `` that contains the values of the current ``` Pair ```
  starting after the callback returns ```` true ````.
<!-- HHAPIDOC -->
