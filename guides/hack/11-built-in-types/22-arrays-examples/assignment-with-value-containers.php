<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\Arrays\AssignmentWithValueContainers;

use namespace HH\Lib\Str;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

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
