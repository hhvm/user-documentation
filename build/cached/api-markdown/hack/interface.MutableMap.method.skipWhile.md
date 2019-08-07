``` yamlmeta
{
    "name": "skipWhile",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableMap"
}
```




Returns a ` MutableMap ` containing the values of the current `` MutableMap ``
starting after and including the first value that produces ``` true ``` when
passed to the specified callback




``` Hack
public function skipWhile(
  callable $fn,
): MutableMap<Tk, Tv>;
```




The returned ` MutableMap ` will always be a proper subset of the current
`` MutableMap ``.




## Parameters




+ ` callable $fn ` - The callback used to determine the starting element for the
  current `` MutableMap ``.




## Returns




* ` MutableMap<Tk, Tv> ` - A `` MutableMap `` that is a proper subset of the current
  ``` MutableMap ``` starting after the callback returns ```` true ````.
<!-- HHAPIDOC -->
