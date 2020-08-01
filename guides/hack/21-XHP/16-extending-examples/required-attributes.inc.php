<?hh // partial

class :user-info extends :x:element {
  attribute int userid @required;
  attribute string name = "";

  protected function render(): \XHPRoot {
    return
      <x:frag>User with id {$this->:userid} has name {$this->:name}</x:frag>;
  }
}
