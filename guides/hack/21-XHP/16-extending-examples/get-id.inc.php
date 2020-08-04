<?hh // partial

use namespace Facebook\XHP\Core as x;
use type Facebook\XHP\HTML\{span, XHPHTMLHelpers};

xhp class my_id extends x\element {
  attribute string id;
  use XHPHTMLHelpers;
  protected async function renderAsync(): Awaitable<x\node> {
    return <span id={$this->:id}>This has an optional random id</span>;
  }
}
