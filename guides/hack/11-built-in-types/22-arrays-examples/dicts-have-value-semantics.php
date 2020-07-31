<?hh // strict

namespace Hack\UserDocumentation\Types\Arrays\Examples\DictsHaveValueSemantics;

use namespace HH\Lib\Str;

<<__EntryPoint>>
function main(): void {
  \__init_autoload();
  $john = make_person('John', 'Doe');
  $emma = make_person('Emma', 'Smith');

  echo Str\format(
    "%s's last name was %s before she got married.\n",
    $emma['first'],
    $emma['last'],
  );

  marry($john, $emma);

  echo Str\format(
    "%s's last name is still %s after she got married.\n",
    $emma['first'],
    $emma['last'],
  );
}

/**
 * This function is now not doing anything,
 * since the modifications are function local.
 */
function marry(dict<string, string> $a, dict<string, string> $b): void {
  $b['last'] = $a['last'];
}

function make_person(
  string $first_name,
  string $last_name,
): dict<string, string> {
  return dict[
    'first' => $first_name,
    'last' => $last_name,
  ];
}
