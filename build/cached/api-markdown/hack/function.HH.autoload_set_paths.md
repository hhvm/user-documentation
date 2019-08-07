``` yamlmeta
{
    "name": "HH\\autoload_set_paths",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/hh/ext_hh.php",
        "api-sources/hhvm/hphp/hack/hhi/functions.hhi"
    ]
}
```




Specify a map containing autoload data




``` Hack
namespace HH;

function autoload_set_paths(
  \    KeyedContainer<string, KeyedContainer<string, string>> $map,
  string $root,
): bool;
```




The map has the form:




```
 array('class'    => array('cls' => 'cls_file.php', ...),
       'function' => array('fun' => 'fun_file.php', ...),
       'constant' => array('con' => 'con_file.php', ...),
       'type'     => array('type' => 'type_file.php', ...),
       'failure'  => callable);
```




If the 'failure' element exists, it will be called if the
lookup in the map fails, or the file cant be included. It
takes a kind ('class', 'function' or 'constant') and the
name of the entity we're trying to autoload.




If $root is non empty, it is prepended to every filename
(so will typically need to end with '/').




## Parameters




+ ` \ KeyedContainer<string, KeyedContainer<string, string>> $map `
+ ` string $root `




## Returns




* ` Boolean ` - TRUE if successful, FALSE otherwise.
<!-- HHAPIDOC -->
