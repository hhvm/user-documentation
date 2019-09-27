namespace Hack\UserDocumentation\ExpAndOps\Coalesce\Idx;

<<__EntryPoint>>
function main(): void {
  $arr = dict['black' => 10, 'white' => null];
  \print_r(vec[
    idx($arr, 'black', -100),  // 10
    idx($arr, 'white', -200),  // null
    idx($arr, 'green', -300),  // -300
    idx($arr, 'green'),        // null
  ]);
}
