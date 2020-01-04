<?hh

namespace Hack\UserDocumentation\Types\Nothing\Examples\EmptyContainer;

function takes_vec_of_strings(vec<string> $_): void {}
function takes_vec_of_bools(vec<bool> $_): void {}

<<__EntryPoint>>
async function main_async(): Awaitable<void> {
  $empty_vec = vec[];
  takes_vec_of_bools($empty_vec);
  takes_vec_of_strings($empty_vec);

  foreach ($empty_vec as $nothing) {
    $nothing->whatever();
    takes_vec_of_strings($nothing);
  }
}
