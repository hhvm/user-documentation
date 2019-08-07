``` yamlmeta
{
    "name": "addAll",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




For every element in the provided ` Traversable `, add the value into the
current `` Set ``




``` Hack
public function addAll(
  ?Traversable<Tv> $iterable,
): Set<Tv>;
```




Future changes made to the original ` Set ` ARE reflected in the returned
`` Set ``, and vice-versa.




## Parameters




+ ` ?Traversable<Tv> $iterable `




## Returns




* ` Set<Tv> ` - Returns itself.




## Examples




The following example adds a collection of values to the ` Set ` `` $s `` and also adds multiple collections of values to ``` $s ``` through chaining. Since ```` Set::addAll() ```` returns a [shallow copy](<https://en.wikipedia.org/wiki/Object_copying#Shallow_copy>) of ` $s ` itself, you can chain a bunch of `` addAll() `` calls together, and that will add all those collection of values to ``` $s ```.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/addAll/001-basic-usage.php @@
<!-- HHAPIDOC -->
