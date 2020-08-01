<?hh // partial

class :introduction extends :x:element {
  protected function render(): \XHPRoot {
    return <strong>Hello!</strong>;
  }
}

class :intro-plain-str extends :x:element {
  protected function render(): \XHPRoot {
    // Since this function returns an XHPRoot, if you want to return a primitive
    // like a string, wrap it around <x:frag>
    return <x:frag>Hello!</x:frag>;
  }
}
