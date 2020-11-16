<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\XHP\Interfaces\AllInOne;

use namespace HH\Lib\Str;

use namespace Facebook\XHP\Core as x;
use type Facebook\XHP\HTML\{div, li};

<<__EntryPoint>>
function all_in_one_xhp_example_main(): void {
  \init_docs_autoloader();

  $inputs = Map {
    '<div />' => <div />,
    '<x:frag />' => <x:frag />,
    '"foo"' => 'foo',
    '3' => 3,
    'true' => true,
    'null' => null,
    'new stdClass()' => new \stdClass(),
    'vec[<li />, <li />, <li />]' => vec[<li />, <li />, <li />],
    'XHPUnsafeExample' => new XHPUnsafeExample(),
  };

  $max_label_len = \max($inputs->mapWithKey(($k, $_) ==> \strlen($k)));
  print \HH\Lib\Str\repeat(' ', $max_label_len + 1)." | XHPRoot | XHPChild\n";
  print \HH\Lib\Str\repeat('-', $max_label_len + 1)."-|---------|----------\n";

  foreach ($inputs as $label => $input) {
    \printf(
      " %s | %-7s | %s\n",
      \HH\Lib\Str\pad_left($label, $max_label_len, ' '),
      $input is x\node ? 'yes' : 'no',
      $input is \XHPChild ? 'yes' : 'no',
    );
  }
}
