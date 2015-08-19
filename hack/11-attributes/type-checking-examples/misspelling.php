<?hh

namespace Hack\UserDocumentation\Attributes\TypeChecking\Examples\Misspell;

<<UserAttr("Hello")>> // Good
class Foo {}

// Commenting out so typechecker will pass all examples
// Uncomment and run hh_client to see how attributes are checked
// against the custom .hhconfig file in this directory
/*
<<EasyToMispell>>     // Error
class Bar {}

<<CASEISIMPORTANT>>   // Error
class Baz {}

<<NotListed>>         // Error
class Yaz {}
*/
