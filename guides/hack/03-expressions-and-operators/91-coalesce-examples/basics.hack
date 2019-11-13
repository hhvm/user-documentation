namespace Hack\UserDocumentation\ExpAndOps\Coalesce\Basics;

<<__EntryPoint>>
function main(): void {
  $nully = null;
  $nonnull = 'a string';
  \print_r(vec[
    $nully ?? 10,    // 10 as $nully is `null`
    $nonnull ?? 10,  // 'a string' as $nonnull is `nonnull`
  ]);

  $arr = dict['black' => 10, 'white' => null];
  \print_r(vec[
    $arr['black'] ?? -100,  // 10 as $arr['black'] is defined and not null
    $arr['white'] ?? -200,  // -200 as $arr['white'] is null
    $arr['green'] ?? -300,  // -300 as $arr['green'] is not defined
  ]);
}
