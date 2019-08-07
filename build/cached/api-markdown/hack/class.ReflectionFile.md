``` yamlmeta
{
    "name": "ReflectionFile",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionFile"
}
```




The ReflectionFile class reports information about a file




## Interface Synopsis




``` Hack
final class ReflectionFile implements Reflector {...}
```




### Public Methods




+ [` ->__construct(string $name) `](</hack/reference/class/ReflectionFile/__construct/>)\
  Constructs a new ReflectionFile

+ [` ->__toString(): string `](</hack/reference/class/ReflectionFile/__toString/>)

+ [` ->getAttribute(string $name): ?varray<mixed> `](</hack/reference/class/ReflectionFile/getAttribute/>)

+ [` ->getAttributeClass<T as HH\FileAttribute>(classname<T> $c): ?T `](</hack/reference/class/ReflectionFile/getAttributeClass/>)

+ [` ->getAttributes(): darray<string, varray<mixed>> `](</hack/reference/class/ReflectionFile/getAttributes/>)

+ [` ->getAttributesNamespaced(): darray<arraykey, varray<mixed>> `](</hack/reference/class/ReflectionFile/getAttributesNamespaced/>)\
  Gets all attributes

+ [` ->getName(): string `](</hack/reference/class/ReflectionFile/getName/>)\
  Get the name of the file








### Private Methods




* [` ->__clone() `](</hack/reference/class/ReflectionFile/__clone/>)
* [` ->__init(string $name): string `](</hack/reference/class/ReflectionFile/__init/>)
<!-- HHAPIDOC -->
