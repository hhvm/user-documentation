<?hh // strict

namespace Hack\UserDocumentation\Types\VarrayDarrayRuntimeOptions\HackArrCompatCheckArrayKeyCast;

use namespace HHVM\UserDocumentation\_Private;

<<__EntryPoint>>
async function main_async(): Awaitable<void> {
  require_once __DIR__.'/../../../../vendor/autoload.hack';
  \Facebook\AutoloadMap\initialize();

  using _Private\print_short_errors();

  /* Before HHVM 4.64, this also applied to varrays.
  $varray = varray[];

  $varray[1.1] = 'A float?!?';
  $varray[true] = 'A bool?!?';
  $varray[null] = 'null?!?';
  */

  $darray = darray[];

  /*HH_IGNORE_ERROR[4371]*/
  $darray[1.1] = 'A float?!?';
  /*HH_IGNORE_ERROR[4371]*/
  $darray[true] = 'A bool?!?';
  /*HH_IGNORE_ERROR[4371]*/
  $darray[null] = 'null?!?';

}
