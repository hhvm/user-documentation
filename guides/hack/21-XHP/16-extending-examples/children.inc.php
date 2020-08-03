<?hh // partial

use namespace Facebook\XHP\ChildValidation as XHPChild;

xhp class my_br extends :x:element {
  use XHPChildValidation;

  protected static function getChildrenDeclaration(): XHPChild\Constraint {
    return XHPChild\empty();
  }


  protected function render(): \XHPRoot {
    return <x:frag>PHP_EOL</x:frag>;
  }
}

xhp class my_ul extends :x:element {
  use XHPChildValidation;

  protected static function getChildrenDeclaration(): XHPChild\Constraint {
    return XHPChild\atLeastOneOf(XHPChild\ofType<:li>());
  }


  protected function render(): \XHPRoot {
    return <ul>{$this->getChildren()}</ul>;
  }
}

xhp class my_html extends :x:element {
  use XHPChildValidation;

  protected static function getChildrenDeclaration(): XHPChild\Constraint {
    return XHPChild\sequence(XHPChild\ofType<:head>(), XHPChild\ofType<:body>(), );
  }


  protected function render(): \XHPRoot {
    return <html>{$this->getChildren()}</html>;
  }
}
