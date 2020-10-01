<?hh

namespace HHVM\UserDocumentation\Guides\Hack\XHP\Introduction\APost;

use namespace Facebook\XHP\Core as x;
use type Facebook\XHP\HTML\{XHPHTMLHelpers, a, form};


final xhp class a_post extends x\element {
  use XHPHTMLHelpers;

  attribute string href @required;
  attribute string target;

  <<__Override>>
  protected async function renderAsync(): Awaitable<x\node> {
    $id = $this->getID();

    $anchor = <a>{$this->getChildren()}</a>;
    $form = (
      <form
        id={$id}
        method="post"
        action={$this->:href}
        target={$this->:target}
        class="postLink">
        {$anchor}
      </form>
    );

    $anchor->setAttribute(
      'onclick',
      'document.getElementById("'.$id.'").submit(); return false;',
    );
    $anchor->setAttribute('href', '#');

    return $form;
  }
}
