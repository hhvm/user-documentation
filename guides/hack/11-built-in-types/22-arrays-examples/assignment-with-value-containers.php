<?hh // strict

namespace Hack\UserDocumentation\Types\Arrays\Examples\AssignmentWithValueContainers;

use namespace HH\Lib\Str;

<<__EntryPoint>>
function main(): void {
  \__init_autoload();
  $emma = dict['first' => 'Emma', 'last' => 'Smith'];
  $another_emma = $emma;

  echo Str\format("$%s's last name is %s.\n", 'emma', $emma['last']);

  $emma['last'] = 'Doe';

  echo Str\format(
    "$%s's last name has been changed to %s.\n",
    'emma',
    $emma['last'],
  );

  echo Str\format(
    "$%s's last name has not been changed and is still %s.\n",
    'another_emma',
    $another_emma['last'],
  );
}
