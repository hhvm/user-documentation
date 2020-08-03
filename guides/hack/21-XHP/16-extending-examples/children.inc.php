<?hh // partial

class :my-br extends :x:element {
  children empty; // no children allowed

  protected function render(): \XHPRoot {
    return <x:frag>PHP_EOL</x:frag>;
  }
}

class :my-ul extends :x:element {
  children (:li)+; // one or more

  protected function render(): \XHPRoot {
    return <ul>{$this->getChildren()}</ul>;
  }
}

class :my-html extends :x:element {
  children (:head, :body);

  protected function render(): \XHPRoot {
    return <html>{$this->getChildren()}</html>;
  }
}
