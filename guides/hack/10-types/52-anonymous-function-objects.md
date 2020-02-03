Hack supports the ability to encapsulate an unnamed function and to use it, or save it for later use, in the context of an anonymous function object. We
can exploit this idea when solving various kinds of problems. For example, a sorting function can sort items in different orders based on sort-key
comparison order. If we have an anonymous function that encapsulates one of some number of compare-functions (such as case-sensitive, case-insensitive,
and dictionary-sort), we can choose the desired approach, encapsulate it, and pass that anonymous function to the sort function to use in its comparison.

[Anonymous functions](../functions/anonymous-functions.md) contains examples of creating and using functions using both closure and lambda notation.

Note: The library functions `class_meth`, `fun`, `inst_meth`, and `meth_caller` allow a string literal containing the name of a function to be
turned into an anonymous function.
