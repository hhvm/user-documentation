<?hh

namespace Hack\UserDocumentation\ErrorCodes\XhpBadChild;


function foo(mixed $m): void {
  /* HH_FIXME[4193] $m may not be an XHPChild.*/
  $my_div = <div>{$m}</div>;
}

class :div {}
