``` yamlmeta
{
    "name": "takeWhile",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Returns a ` Set ` containing the values of the current `` Set `` up to but not
including the first value that produces ``` false ``` when passed to the
specified callback




``` Hack
public function takeWhile(
  callable $callback,
): Set<Tv>;
```




The returned ` Set ` will always be a proper subset of the current `` Set ``.




## Parameters




+ ` callable $callback `




## Returns




* ` Set<Tv> ` - A `` Set `` that is a proper subset of the current ``` Set ``` up until
  the callback returns ```` false ````.




## Examples




This example shows how ` takeWhile ` can be used to create a new `` Set `` by taking elements from the beginning of an existing ``` Set ```:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/takeWhile/001-basic-usage.php @@
<!-- HHAPIDOC -->
