``` yamlmeta
{
    "name": "skipWhile",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Returns a ` Set ` containing the values of the current `` Set `` starting after
and including the first value that produces ``` true ``` when passed to the
specified callback




``` Hack
public function skipWhile(
  callable $fn,
): Set<Tv>;
```




The returned ` Set ` will always be a proper subset of the current `` Set ``.




## Parameters




+ ` callable $fn ` - The callback used to determine the starting element for the
  `` Set ``.




## Returns




* ` Set<Tv> ` - A `` Set `` that is a proper subset of the current ``` Set ``` starting
  after the callback returns ```` true ````.




## Examples




This example shows how ` skipWhile ` can be used to create a new `` Set `` by skipping elements at the beginning of an existing ``` Set ```:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/skipWhile/001-basic-usage.php @@
<!-- HHAPIDOC -->
