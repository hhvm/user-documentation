``` yamlmeta
{
    "name": "ReflectionClass",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




( excerpt from http://php




net/manual/en/class.reflectionclass.php )




The ReflectionClass class reports information about a class.




## Interface Synopsis




``` Hack
class ReflectionClass implements Reflector {...}
```




### Public Methods




+ [` ::export(mixed $argument, bool $return = false): ?string `](</hack/reference/class/ReflectionClass/export/>)\
  ( excerpt from http://php

+ [` ->__clone() `](</hack/reference/class/ReflectionClass/__clone/>)

+ [` ->__construct(mixed $name_or_obj) `](</hack/reference/class/ReflectionClass/__construct/>)\
  ( excerpt from http://php

+ [` ->__toString(): string `](</hack/reference/class/ReflectionClass/__toString/>)\
  ( excerpt from http://php

+ [` ->getAbstractConstantNames(): darray<string> `](</hack/reference/class/ReflectionClass/getAbstractConstantNames/>)\
  ( excerpt from
  http://php

+ [` ->getAttribute(string $name): ?varray<mixed> `](</hack/reference/class/ReflectionClass/getAttribute/>)

+ [` ->getAttributeClass<T as HH\ClassLikeAttribute>(classname<T> $c): ?T `](</hack/reference/class/ReflectionClass/getAttributeClass/>)

+ [` ->getAttributeRecursive(string $name): ?varray<mixed> `](</hack/reference/class/ReflectionClass/getAttributeRecursive/>)

+ [` ->getAttributes(): darray<string, varray<mixed>> `](</hack/reference/class/ReflectionClass/getAttributes/>)

+ [` ->getAttributesNamespaced(): darray<string, array<mixed>> `](</hack/reference/class/ReflectionClass/getAttributesNamespaced/>)

+ [` ->getAttributesRecursive(): darray<string, varray<mixed>> `](</hack/reference/class/ReflectionClass/getAttributesRecursive/>)

+ [` ->getAttributesRecursiveNamespaced(): darray<string, varray<mixed>> `](</hack/reference/class/ReflectionClass/getAttributesRecursiveNamespaced/>)

+ [` ->getConstant(string $name): mixed `](</hack/reference/class/ReflectionClass/getConstant/>)\
  ( excerpt from http://php

+ [` ->getConstants(): darray<string, mixed> `](</hack/reference/class/ReflectionClass/getConstants/>)\
  ( excerpt from http://php

+ [` ->getConstructor(): ?ReflectionMethod `](</hack/reference/class/ReflectionClass/getConstructor/>)\
  ( excerpt from
  http://php

+ [` ->getDefaultProperties(): darray<string, mixed> `](</hack/reference/class/ReflectionClass/getDefaultProperties/>)\
  ( excerpt from
  http://php

+ [` ->getDocComment(): mixed `](</hack/reference/class/ReflectionClass/getDocComment/>)\
  ( excerpt from
  http://php

+ [` ->getEndLine(): int `](</hack/reference/class/ReflectionClass/getEndLine/>)\
  ( excerpt from http://php

+ [` ->getExtension(): ?ReflectionExtension `](</hack/reference/class/ReflectionClass/getExtension/>)\
  ( excerpt from http://php

+ [` ->getExtensionName(): string `](</hack/reference/class/ReflectionClass/getExtensionName/>)\
  ( excerpt from
  http://php

+ [` ->getFile(): ReflectionFile `](</hack/reference/class/ReflectionClass/getFile/>)\
  Gets the declaring file for the reflected class

+ [` ->getFileName(): mixed `](</hack/reference/class/ReflectionClass/getFileName/>)\
  ( excerpt from http://php

+ [` ->getInterfaceNames(): varray<string> `](</hack/reference/class/ReflectionClass/getInterfaceNames/>)\
  ( excerpt from
  http://php

+ [` ->getInterfaces(): darray<string, ReflectionClass> `](</hack/reference/class/ReflectionClass/getInterfaces/>)\
  ( excerpt from
  http://php

+ [` ->getMethod(string $name): ReflectionMethod `](</hack/reference/class/ReflectionClass/getMethod/>)\
  ( excerpt from http://php

+ [` ->getMethods(?int $filter = NULL): varray<ReflectionMethod> `](</hack/reference/class/ReflectionClass/getMethods/>)\
  ( excerpt from http://php

+ [` ->getModifiers(): int `](</hack/reference/class/ReflectionClass/getModifiers/>)\
  ( excerpt from http://php

+ [` ->getName(): string `](</hack/reference/class/ReflectionClass/getName/>)

+ [` ->getNamespaceName(): string `](</hack/reference/class/ReflectionClass/getNamespaceName/>)\
  ( excerpt from
  http://php

+ [` ->getParentClass(): mixed `](</hack/reference/class/ReflectionClass/getParentClass/>)\
  ( excerpt from
  http://php

+ [` ->getProperties(int $filter = 65535): varray<ReflectionProperty> `](</hack/reference/class/ReflectionClass/getProperties/>)\
  ( excerpt* http://php

+ [` ->getProperty(string $name): ReflectionProperty `](</hack/reference/class/ReflectionClass/getProperty/>)\
  ( excerpt from http://php

+ [` ->getRequirementNames(): varray<string> `](</hack/reference/class/ReflectionClass/getRequirementNames/>)\
  Gets the list of implemented interfaces/inherited classes needed to
  implement an interface / use a trait

+ [` ->getRequirements(): darray<string, ReflectionClass> `](</hack/reference/class/ReflectionClass/getRequirements/>)\
  Gets ReflectionClass-es for the requirements of this class

+ [` ->getShortName(): string `](</hack/reference/class/ReflectionClass/getShortName/>)\
  ( excerpt from
  http://php

+ [` ->getStartLine(): int `](</hack/reference/class/ReflectionClass/getStartLine/>)\
  ( excerpt from http://php

+ [` ->getStaticProperties(): darray<string, mixed> `](</hack/reference/class/ReflectionClass/getStaticProperties/>)\
  ( excerpt from
  http://php

+ [` ->getStaticPropertyValue(string $name, mixed ...$def_value = NULL): mixed `](</hack/reference/class/ReflectionClass/getStaticPropertyValue/>)\
  ( excerpt from
  http://php

+ [` ->getTraitAliases(): darray<string> `](</hack/reference/class/ReflectionClass/getTraitAliases/>)\
  ( excerpt from
  http://php

+ [` ->getTraitNames(): varray<string> `](</hack/reference/class/ReflectionClass/getTraitNames/>)\
  ( excerpt from
  http://php

+ [` ->getTraits(): darray<string, ReflectionClass> `](</hack/reference/class/ReflectionClass/getTraits/>)\
  ( excerpt from http://php

+ [` ->getTypeConstant(string $name): ReflectionTypeConstant `](</hack/reference/class/ReflectionClass/getTypeConstant/>)

+ [` ->getTypeConstants(): varray<ReflectionTypeConstant> `](</hack/reference/class/ReflectionClass/getTypeConstants/>)

+ [` ->hasConstant(string $name): bool `](</hack/reference/class/ReflectionClass/hasConstant/>)\
  ( excerpt from http://php

+ [` ->hasMethod(string $name): bool `](</hack/reference/class/ReflectionClass/hasMethod/>)\
  ( excerpt from http://php

+ [` ->hasProperty(string $name): bool `](</hack/reference/class/ReflectionClass/hasProperty/>)\
  ( excerpt from http://php

+ [` ->hasTypeConstant(string $name): bool `](</hack/reference/class/ReflectionClass/hasTypeConstant/>)

+ [` ->implementsInterface(string $interface): bool `](</hack/reference/class/ReflectionClass/implementsInterface/>)\
  ( excerpt from
  http://php

+ [` ->inNamespace(): bool `](</hack/reference/class/ReflectionClass/inNamespace/>)\
  ( excerpt from http://php

+ [` ->isAbstract(): bool `](</hack/reference/class/ReflectionClass/isAbstract/>)\
  ( excerpt from http://php

+ [` ->isCloneable(): bool `](</hack/reference/class/ReflectionClass/isCloneable/>)\
  ( excerpt from
  http://php

+ [` ->isEnum(): bool `](</hack/reference/class/ReflectionClass/isEnum/>)\
  Returns whether this ReflectionClass represents an enum

+ [` ->isFinal(): bool `](</hack/reference/class/ReflectionClass/isFinal/>)\
  ( excerpt from http://php

+ [` ->isHack(): bool `](</hack/reference/class/ReflectionClass/isHack/>)

+ [` ->isInstance(mixed $obj): bool `](</hack/reference/class/ReflectionClass/isInstance/>)\
  ( excerpt from http://php

+ [` ->isInstantiable(): bool `](</hack/reference/class/ReflectionClass/isInstantiable/>)\
  ( excerpt from
  http://php

+ [` ->isInterface(): bool `](</hack/reference/class/ReflectionClass/isInterface/>)\
  ( excerpt from http://php

+ [` ->isInternal(): bool `](</hack/reference/class/ReflectionClass/isInternal/>)\
  ( excerpt from http://php

+ [` ->isIterateable(): bool `](</hack/reference/class/ReflectionClass/isIterateable/>)\
  ( excerpt from
  http://php

+ [` ->isSubclassOf(mixed $class): bool `](</hack/reference/class/ReflectionClass/isSubclassOf/>)\
  ( excerpt from http://php

+ [` ->isTrait(): bool `](</hack/reference/class/ReflectionClass/isTrait/>)\
  ( excerpt from http://php

+ [` ->isUserDefined(): bool `](</hack/reference/class/ReflectionClass/isUserDefined/>)

+ [` ->newInstance(...$args) `](</hack/reference/class/ReflectionClass/newInstance/>)\
  ( excerpt from http://php

+ [` ->newInstanceArgs(Traversable<mixed> $args = array ( )) `](</hack/reference/class/ReflectionClass/newInstanceArgs/>)\
  ( excerpt from
  http://php

+ [` ->newInstanceWithoutConstructor() `](</hack/reference/class/ReflectionClass/newInstanceWithoutConstructor/>)\
  ( excerpt from
  http://php

+ [` ->setStaticPropertyValue(string $name, mixed $value): void `](</hack/reference/class/ReflectionClass/setStaticPropertyValue/>)\
  ( excerpt from
  http://php








### Private Methods




* [` ::getAbstractConstantNamesCache(string $clsname): darray<string, string> `](</hack/reference/class/ReflectionClass/getAbstractConstantNamesCache/>)
* [` ::getClassPropertyInfo(string $clsname): array `](</hack/reference/class/ReflectionClass/getClassPropertyInfo/>)
* [` ::getConstantsCache(string $clsname): darray<string, mixed> `](</hack/reference/class/ReflectionClass/getConstantsCache/>)
* [` ::getMethodOrder(string $clsname, int $filter): object `](</hack/reference/class/ReflectionClass/getMethodOrder/>)
* [` ::getMethodOrderCache(string $clsname): Set<string> `](</hack/reference/class/ReflectionClass/getMethodOrderCache/>)
* [` ::getOrderedAbstractConstants(string $clsname): darray<string, string> `](</hack/reference/class/ReflectionClass/getOrderedAbstractConstants/>)
* [` ::getOrderedConstants(string $clsname): darray<string, mixed> `](</hack/reference/class/ReflectionClass/getOrderedConstants/>)
* [` ::getOrderedTypeConstants(string $clsname): darray<string, string> `](</hack/reference/class/ReflectionClass/getOrderedTypeConstants/>)
* [` ::getPropsMapCache(string $clsname): ImmMap<string, mixed> `](</hack/reference/class/ReflectionClass/getPropsMapCache/>)
* [` ::getTypeConstantNamesCache(string $clsname): darray<string, string> `](</hack/reference/class/ReflectionClass/getTypeConstantNamesCache/>)
* [` ->__init(string $name): string `](</hack/reference/class/ReflectionClass/__init/>)
* [` ->getConstructorName(): string `](</hack/reference/class/ReflectionClass/getConstructorName/>)
* [` ->getDynamicPropertyInfos(object $obj): array<string, mixed> `](</hack/reference/class/ReflectionClass/getDynamicPropertyInfos/>)
* [` ->getMethodOrderWithCaching(?int $filter): Set<string> `](</hack/reference/class/ReflectionClass/getMethodOrderWithCaching/>)
* [` ->getOrderedPropertyInfos(): ConstMap<string, mixed> `](</hack/reference/class/ReflectionClass/getOrderedPropertyInfos/>)
* [` ->getParentName(): string `](</hack/reference/class/ReflectionClass/getParentName/>)
* [` ->getReflectionClassesFromNames(varray<string> $names) `](</hack/reference/class/ReflectionClass/getReflectionClassesFromNames/>)\
  Helper for the get{Traits,Interfaces,Requirements} methods
* [` ->getTypeConstantNamesWithCaching(): darray<string, string> `](</hack/reference/class/ReflectionClass/getTypeConstantNamesWithCaching/>)
<!-- HHAPIDOC -->
