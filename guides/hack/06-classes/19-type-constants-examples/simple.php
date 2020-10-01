<?hh

namespace Hack\UserDocumentation\Classes\TypeConstants\Examples\Simple;

abstract class CBase {
  abstract const type T;
  // ...
}

class CString extends CBase {
  const type T = string;
  // ...
}
