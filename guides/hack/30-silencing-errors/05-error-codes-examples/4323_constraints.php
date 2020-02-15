<?hh

namespace Hack\UserDocumentation\ErrorCodes\GenericConstraintsNotSatisfied;


/* HH_FIXME[4323] A dict must have arraykey, int or string keys. */
function foo(dict<mixed, bool> $d): void {}
