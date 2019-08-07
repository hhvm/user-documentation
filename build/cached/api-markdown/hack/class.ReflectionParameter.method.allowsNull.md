``` yamlmeta
{
    "name": "allowsNull",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection-classes.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionParameter"
}
```




( excerpt from
http://php




``` Hack
public function allowsNull();
```




net/manual/en/reflectionparameter.allowsnull.php )




Checks whether the parameter allows NULL. Warning: This function is
currently not documented; only its argument list is available.




## Returns




+ ` mixed ` - TRUE if NULL is allowed, otherwise FALSE
<!-- HHAPIDOC -->
