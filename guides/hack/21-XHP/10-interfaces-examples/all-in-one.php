<?hh // partial

<<__EntryPoint>>
function all_in_one_xhp_example_main(): void {
  \__init_autoload();
  $inputs = Map {
    '<div />' => <div />,
    '<x:frag />' => <x:frag />,
    '"foo"' => 'foo',
    '3' => 3,
    'true' => true,
    'null' => null,
    'new stdClass()' => new stdClass(),
    'vec[<li />, <li />, <li />]' => vec[<li />, <li />, <li />],
    'XHPUnsafeExample' => new XHPUnsafeExample(),
  };

  $max_label_len = max($inputs->mapWithKey(($k, $_) ==> strlen($k)));
  print \HH\Lib\Str\repeat(' ', $max_label_len + 1)." | XHPRoot | XHPChild\n";
  print \HH\Lib\Str\repeat('-', $max_label_len + 1)."-|---------|----------\n";

  foreach ($inputs as $label => $input) {
    printf(
      " %s | %-7s | %s\n",
      \HH\Lib\Str\pad_left($label, $max_label_len, ' '),
      $input is XHPRoot ? 'yes' : 'no',
      $input is XHPChild ? 'yes' : 'no',
    );
  }
}
