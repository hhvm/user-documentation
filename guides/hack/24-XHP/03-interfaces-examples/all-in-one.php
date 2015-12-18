<?hh
require __DIR__ . "/../../../../vendor/hh_autoload.php";

final class XHPUnsafeExample implements XHPUnsafeRenderable {
  public function toHTMLString(): string {
    return '<script>'.$_GET['I_LOVE_XSS'].'</script>';
  }
}

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
print str_repeat(' ', $max_label_len + 1)." | XHPRoot | XHPChild\n";
print str_repeat('-', $max_label_len + 1)."-|---------|----------\n";

foreach ($inputs as $label => $input) {
  printf(
    " %{$max_label_len}s | %-7s | %s\n",
    $label,
    $input instanceof XHPRoot ? 'yes' : 'no',
    $input instanceof XHPChild ? 'yes' : 'no',
  );
}
