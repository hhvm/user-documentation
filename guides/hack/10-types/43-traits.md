Hack's class model allows single inheritance with contracts being enforced separately via interfaces. A *trait* can provide both implementation
and contracts. Specifically, a class can inherit from a base class while getting implementation from one or more traits. At the same time, that
class can implement contracts from one or more interfaces as well as from one or more traits. The use of a trait by a class does not involve any
inheritance hierarchy, so unrelated classes can use the same trait. In summary, a trait is a set of methods and/or state information that can be
reused. Traits are designed to support classes; a trait cannot be instantiated directly.

Trait types are described in [$$](../classes/using-a-trait.md).

Although traits are used to declare class and interface types, a trait type *cannot* be used in the usual context of a type name. However,
for the purposes of [subtyping](supertypes-and-subtypes.md), traits are considered to be types.
