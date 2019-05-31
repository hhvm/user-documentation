<?hh // strict

namespace HHVM\UserDocumentation\Tests;

function expect<T>(T $in): ExpectObj<T> {
  return new ExpectObj($in);
}
