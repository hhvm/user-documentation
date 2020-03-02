<?hh // strict

namespace Hack\UserDocumentation\Types\VarrayDarrayRuntimeOptions\HackArrCompatCheckImplicitVarrayAppend;

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

  $varray[2] = <<<EOF
Writing to the first unused key of a varray.
Varray's behave differently here than vecs.
EOF;
}
