``` yamlmeta
{
    "name": "add",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Add the value to the current ` Set `




``` Hack
public function add(
  Tv $val,
): Set<Tv>;
```




` $set->add($v) ` is semantically equivalent to `` $set[] = $v `` (except that
``` add() ``` returns the ```` Set ````).




Future changes made to the current ` Set ` ARE reflected in the returned
`` Set ``, and vice-versa.




## Parameters




+ ` Tv $val `




## Returns




* ` Set<Tv> ` - Returns itself.




## Examples




The following example adds a single value to the ` Set ` `` $s `` and also adds multiple values to ``` $s ``` through chaining. Since ```` Set::add() ```` returns a [shallow copy](<https://en.wikipedia.org/wiki/Object_copying#Shallow_copy>) of ` $s ` itself, you can chain a bunch of `` add() `` calls together, and that will add all those values to ``` $s ```. Notice that adding a value that already exists in the ```` Set ```` has no effect.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/add/001-basic-usage.php @@
<!-- HHAPIDOC -->
