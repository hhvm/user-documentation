``` yamlmeta
{
    "name": "splice",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Splice the current ` Vector ` in place




``` Hack
public function splice(
  int $offset,
  ?int $len = NULL,
): void;
```




This function provides the functionality of
[` array_splice() `](<http://php.net/manual/en/function.array-splice.php>)
for `` Vector ``s (except that ``` splice() ``` does not permit specifying
replacement values.  If a third ("replacement values") parameter is
specified, an exception is thrown.










Note that this function modifies the current ` Vector ` in place.




## Parameters




+ ` int $offset ` - The (0-based) key at which to begin the splice. If
  negative, then it starts that far from the end of the
  current `` Vector ``.
+ ` ?int $len = NULL ` - The length of the splice. If `` null ``, then the current
  ``` Vector ``` is spliced until its end.




## Returns




* ` void `




## Examples




The following example shows how to use ` $offset ` and `` $len `` together:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/splice/001-basic-usage.php @@
<!-- HHAPIDOC -->
