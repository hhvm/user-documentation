A *class* is an object type that contains the data and function members associated with that type.  (A function defined inside a class is 
called a *method*.)  A class supports the object-oriented ideas of *encapsulation* and *data hiding*.

An object---often called an *instance*---of a class type is created (i.e., *instantiated*) via the [new operator](../expressions-and-operators/new.md).

Hack supports [*inheritance*](inheritance.md), a means by which a *derived class* can *extend* and specialize a single *base class*.

A class may *implement* one or more [*interfaces*](implementing-an-interface.md), each of which defines a contract.

A class can *use* one or more [*traits*](using-a-trait.md), which allows a class to have some of the benefits of multiple inheritance.

The members of a class each have a default or explicitly declared *visibility*, which determines what source code can access them.  
Specifically:
* A member with `private` visibility may be accessed only from within its own class.
* A member with `protected` visibility may be accessed only from within its own class and from classes derived from that class.
* Access to a member with `public` visibility is unrestricted.  
