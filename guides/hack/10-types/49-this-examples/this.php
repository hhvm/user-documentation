<?hh // strict

namespace Hack\UserDocumentation\Types\This\Examples\Interface;

interface I1 {
  abstract const type T1 as arraykey;
  public function get_ID(): this::T1;
}
