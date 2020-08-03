<?hh // partial

class :my-text extends :x:element {
  category %phrase;
  children (pcdata | %phrase); // prefixed colon ommitted purposely on pcdata

  protected function render(): \XHPRoot {
    return <x:frag>{$this->getChildren('%phrase')}</x:frag>;
  }
}
