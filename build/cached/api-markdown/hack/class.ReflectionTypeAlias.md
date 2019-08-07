``` yamlmeta
{
    "name": "ReflectionTypeAlias",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionTypeAlias"
}
```




The ReflectionTypeAlias class reports information about a type
alias




## Interface Synopsis




``` Hack
class ReflectionTypeAlias implements Reflector {...}
```




### Public Methods




+ [` ->__construct(string $name) `](</hack/reference/class/ReflectionTypeAlias/__construct/>)\
  Constructs a new ReflectionTypeAlias

+ [` ->__toString(): string `](</hack/reference/class/ReflectionTypeAlias/__toString/>)

+ [` ->getAssignedTypeText(): string `](</hack/reference/class/ReflectionTypeAlias/getAssignedTypeText/>)\
  Get the assigned type as a string

+ [` ->getAttribute(string $name): ?varray<mixed> `](</hack/reference/class/ReflectionTypeAlias/getAttribute/>)

+ [` ->getAttributeClass<T as HH\TypeAliasAttribute>(classname<T> $c): ?T `](</hack/reference/class/ReflectionTypeAlias/getAttributeClass/>)

+ [` ->getAttributes(): darray<string, varray<mixed>> `](</hack/reference/class/ReflectionTypeAlias/getAttributes/>)

+ [` ->getAttributesNamespaced(): darray<arraykey, varray<mixed>> `](</hack/reference/class/ReflectionTypeAlias/getAttributesNamespaced/>)\
  Gets all attributes

+ [` ->getFile(): ReflectionFile `](</hack/reference/class/ReflectionTypeAlias/getFile/>)\
  Gets the declaring file for the reflected type alias

+ [` ->getFileName(): string `](</hack/reference/class/ReflectionTypeAlias/getFileName/>)\
  Get the name of the file in which the type alias was defined

+ [` ->getName(): string `](</hack/reference/class/ReflectionTypeAlias/getName/>)\
  Get the name of the type alias

+ [` ->getResolvedTypeStructure(): darray `](</hack/reference/class/ReflectionTypeAlias/getResolvedTypeStructure/>)\
  Get the TypeStructure with type information resolved

+ [` ->getTypeStructure(): darray `](</hack/reference/class/ReflectionTypeAlias/getTypeStructure/>)\
  Get the TypeStructure that contains the full type information of
  the assigned type








### Private Methods




* [` ->__clone() `](</hack/reference/class/ReflectionTypeAlias/__clone/>)
* [` ->__init(string $name): string `](</hack/reference/class/ReflectionTypeAlias/__init/>)
<!-- HHAPIDOC -->
