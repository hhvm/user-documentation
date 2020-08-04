<?hh // partial

use namespace Facebook\XHP\Core as x;
use type Facebook\XHP\HTML\strong;

final xhp class introduction extends x\element {
  protected async function renderAsync(): Awaitable<x\node> {
    return <strong>Hello!</strong>;
  }
}

final xhp class intro_plain_str extends x\element {
  protected async function renderAsync(): Awaitable<x\node> {
    // Since this function returns an XHPRoot, if you want to return a primitive
    // like a string, wrap it around <x:frag>
    return <x:frag>Hello!</x:frag>;
  }
}
