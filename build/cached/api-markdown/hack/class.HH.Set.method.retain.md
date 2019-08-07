``` yamlmeta
{
    "name": "retain",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Alters the current ` Set ` so that it only contains the values that meet a
supplied condition on each value




``` Hack
public function retain(
  callable $callback,
): Set<Tv>;
```




This method is like ` filter() `, but mutates the current `` Set `` too in
addition to returning the current ``` Set ```.




Future changes made to the current ` Set ` ARE reflected in the returned
`` Set ``, and vice-versa.




## Parameters




+ ` callable $callback ` - The callback containing the condition to apply to the
  current `` Set `` values.




## Returns




* ` Set<Tv> ` - Returns itself.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/retain/001-basic-usage.php @@
<!-- HHAPIDOC -->
