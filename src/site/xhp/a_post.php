<?hh // strict

require_once(__DIR__."/../../../vendor/hh_autoload.php");

final class :a:post extends :x:element {
  attribute :a;

  use XHPHelpers;

  protected function render(): XHPRoot {
    $id = $this->getID();

    $anchor = <a>{$this->getChildren()}</a>;
    $form = (
      <form
        id={$id}
        method="post"
        action={$this->:href}
        target={$this->:target}
        class="postLink"
      >{$anchor}</form>
    );

    $this->transferAllAttributes($anchor);
    $anchor->setAttribute(
      'onclick',
      'document.getElementById("'.$id.'").submit(); return false;',
    );
    $anchor->setAttribute('href', '#');

    return $form;
  }
}
