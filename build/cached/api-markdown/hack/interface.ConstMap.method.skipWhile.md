``` yamlmeta
{
    "name": "skipWhile",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstMap"
}
```




Returns a ` ConstMap ` containing the values of the current `` ConstMap ``
starting after and including the first value that produces ``` true ``` when
passed to the specified callback




``` Hack
public function skipWhile(
  callable $fn,
): ConstMap<Tk, Tv>;
```




The returned ` ConstMap ` will always be a proper subset of the current
`` ConstMap ``.




## Parameters




+ ` callable $fn ` - The callback used to determine the starting element for the
  current `` ConstMap ``.




## Returns




* ` ConstMap<Tk, Tv> ` - A `` ConstMap `` that is a proper subset of the current ``` ConstMap ```
  starting after the callback returns ```` true ````.
<!-- HHAPIDOC -->
