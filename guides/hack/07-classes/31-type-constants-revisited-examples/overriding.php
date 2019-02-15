<?hh // strict

namespace Hack\UserDocumentation\Classes\TypeConstantsRevisited\Examples\Overriding;

abstract class BaseAbstract {
  abstract const type T;
}

class ChildWithConstraint extends BaseAbstract {
  // We can override this constraint in a child of this concrete class
  // since we provided an explicit "as constraint".
  const type T as ?arraykey = ?arraykey;
}

class ChildOfChildWithNoConstraint extends ChildWithConstraint {
  // Cannot override this in a child of this class.
  const type T = arraykey;
}

<<__EntryPoint>>
function run(): void {
  echo "No real output!";
}
