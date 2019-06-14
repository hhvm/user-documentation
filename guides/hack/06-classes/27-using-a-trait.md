Hack's class model allows single inheritance with contracts being enforced separately via [interfaces](implementing-an-interface.md). A *trait* can provide
both implementation and contracts. Specifically, a class can inherit from a base class while getting implementation from one or more traits.
At the same time, that class can implement contracts from one or more interfaces as well as from one or more traits. The use of a trait by a
class does not involve any inheritance hierarchy, so unrelated classes can use the same trait. In summary, a trait is a set of methods and/or
state information that can be reused.  For example:

@@ using-a-trait-examples/Common.php @@

As shown, a trait can *use* one or more traits, and a class can also use one or more traits, via one or more `use` clauses:

The members of a trait each have visibility, which applies once they are used by a given class. The class that uses a trait can change the
visibility of any of that trait's members, by widening or narrowing that visibility. For example, a private trait member can be made public
in the using class, and a public trait member can be made private in that class.

Once implementation comes from both a base class and one or more traits, name conflicts can occur. However, currently, there is no mechanism to
disambiguate such names.

A class member with a given name overrides one with the same name in any traits that class uses, which, in turn, overrides any such name from base classes.

Traits can contain both instance and static members, including both methods and properties. In the case of a trait with a static property,
each class using that trait has its own instance of that property.

Methods in a trait have full access to all members of any class in which that trait is used.

Traits are designed to support classes; a trait cannot be instantiated directly.

A trait can have usage requirements placed on it; see [$$](trait-and-interface-requirements.md) for more information.
