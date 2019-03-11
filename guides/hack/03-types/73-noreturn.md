After executing, almost all functions return to their caller. However, in certain very-specialized situations, a function might always 
throw an exception or terminate the program abnormally (such as by calling the library function `exit`). Such functions have the return 
type `noreturn`, and must not contain any `return` statements. Strictly speaking, `noreturn` is not a type; it is just used in one type
context, in place of a type.
