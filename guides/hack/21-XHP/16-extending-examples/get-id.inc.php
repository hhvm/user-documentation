<?hh // partial

class :my-id extends :x:element {
  attribute string id;
  use XHPHelpers;
  protected function render(): \XHPRoot {
    return <span id={$this->getID()}>This has a random id</span>;
  }
}
