<?hh // strict

namespace Hack\UserDocumentation\Types\VarrayDarrayRuntimeOptions\HackArrCompatCheckVarrayPromote;

use namespace HHVM\UserDocumentation\_Private;

<<__EntryPoint>>
async function main_async(): Awaitable<void> {
  require_once __DIR__.'/../../../../vendor/autoload.hack';
  \Facebook\AutoloadMap\initialize();

  using _Private\print_short_errors();

  $varray = varray[];

  /*HH_IGNORE_ERROR[4324]*/
  $varray[1.1] = 'A float?!?';
  /*HH_IGNORE_ERROR[4324]*/
  $varray[true] = 'A bool?!?';
  /*HH_IGNORE_ERROR[4324]*/
  $varray[null] = 'null?!?';

  $darray = darray[];

  $darray[1.1] = 'A float?!?';
  $darray[true] = 'A bool?!?';
  $darray[null] = 'null?!?';

}
