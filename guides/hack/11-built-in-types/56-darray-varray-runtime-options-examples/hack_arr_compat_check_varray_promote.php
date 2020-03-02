<?hh // strict

namespace Hack\UserDocumentation\Types\VarrayDarrayRuntimeOptions\HackArrCompatCheckVarrayPromote;

use namespace HHVM\UserDocumentation\_Private;

<<__EntryPoint>>
async function main_async(): Awaitable<void> {
  require_once __DIR__.'/../../../../vendor/autoload.hack';
  \Facebook\AutoloadMap\initialize();

  using _Private\print_short_errors();

  $varray = varray[
    'HHVM',
    'HACK',
  ];

  $varray[3] = <<<EOF
Writing to a key that is not already in use nor the first unused key.
A vec<_> would throw an exception here.
EOF;

  $varray = varray[
    'HHVM',
    'HACK',
  ];

  /*HH_IGNORE_ERROR[4135] This is banned in strict mode, but needs to be illustated.*/
  unset($varray[0]);
  // Using unset on an index that is not the greatest index.

  $varray = varray[
    'HHVM',
    'HACK',
  ];

  /*HH_IGNORE_ERROR[4324] This is banned in Hack, but needs to be illustated.*/
  $varray['string'] = <<<EOF
Writing to a string key in a will escalate it to a darray<_, _>.
A vec would throw an exception here.
EOF;
}
