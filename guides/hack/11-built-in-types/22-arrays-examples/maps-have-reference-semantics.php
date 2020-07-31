<?hh // strict

namespace Hack\UserDocumentation\Types\Arrays\Examples\MapsHaveReferenceSemantics;

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
    "%s's last name is now %s after she got married.\n",
    $emma['first'],
    $emma['last'],
  );
}

/**
 * I modify $b and you'll be able to observe these changes in your $emma.
 */
function marry(Map<string, string> $a, Map<string, string> $b): void {
  $b['last'] = $a['last'];
}

function make_person(
  string $first_name,
  string $last_name,
): Map<string, string> {
  return Map {
    'first' => $first_name,
    'last' => $last_name,
  };
}
