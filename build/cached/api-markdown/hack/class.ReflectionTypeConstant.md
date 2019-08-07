``` yamlmeta
{
    "name": "ReflectionTypeConstant",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionTypeConstant"
}
```




The ReflectionTypeConstant class reports information about an object




## Interface Synopsis




``` Hack
class ReflectionTypeConstant implements Reflector {...}
```




### Public Methods




+ [` ::export($class, string $name, $return = false) `](</hack/reference/class/ReflectionTypeConstant/export/>)

+ [` ->__construct(mixed $class, string $name) `](</hack/reference/class/ReflectionTypeConstant/__construct/>)\
  Constructs a new ReflectionTypeConstant

+ [` ->__toString(): string `](</hack/reference/class/ReflectionTypeConstant/__toString/>)

+ [` ->getAssignedTypeText(): ?string `](</hack/reference/class/ReflectionTypeConstant/getAssignedTypeText/>)\
  Get the type assigned to this type constant as a string

+ [` ->getClass(): ReflectionClass `](</hack/reference/class/ReflectionTypeConstant/getClass/>)\
  Gets the class for the reflected type constant

+ [` ->getDeclaringClass(): ReflectionClass `](</hack/reference/class/ReflectionTypeConstant/getDeclaringClass/>)\
  Gets the declaring class for the reflected type constant

+ [` ->getName(): string `](</hack/reference/class/ReflectionTypeConstant/getName/>)\
  Get the name of the type constant

+ [` ->getTypeStructure() `](</hack/reference/class/ReflectionTypeConstant/getTypeStructure/>)

+ [` ->isAbstract(): bool `](</hack/reference/class/ReflectionTypeConstant/isAbstract/>)\
  Checks if the type constant is abstract











### Private Methods




* [` ->__clone() `](</hack/reference/class/ReflectionTypeConstant/__clone/>)
* [` ->__init(mixed $cls_or_obj, string $const): bool `](</hack/reference/class/ReflectionTypeConstant/__init/>)
* [` ->getAssignedTypeHint(): string `](</hack/reference/class/ReflectionTypeConstant/getAssignedTypeHint/>)
* [` ->getClassname(): string `](</hack/reference/class/ReflectionTypeConstant/getClassname/>)
* [` ->getDeclaringClassname(): string `](</hack/reference/class/ReflectionTypeConstant/getDeclaringClassname/>)
<!-- HHAPIDOC -->
