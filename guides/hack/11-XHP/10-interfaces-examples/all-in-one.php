<?hh
require __DIR__ . "/../../../../vendor/hh_autoload.php";

final class XHPUnsafeExample implements XHPUnsafeRenderable {
  public function toHTMLString(): string {
    return '<script>'.$_GET['I_LOVE_XSS'].'</script>';
  }
}

<<__EntryPoint>>
function main(): void {
  $inputs = Map {
    '<div />' => <div />,
    '<x:frag />' => <x:frag />,
    '"foo"' => 'foo',
    '3' => 3,
    'true' => true,
    'null' => null,
    'new stdClass()' => new stdClass(),
    '[<li />, <li />, <li />]' => [<li />, <li />, <li />],
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

