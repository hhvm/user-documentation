<?hh // partial

use namespace Facebook\XHP\ChildValidation as XHPChild;

xhp class my_text extends :x:element {
  use XHPChildValidation;
  category %phrase;

  protected static function getChildrenDeclaration(): XHPChild\Constraint {
    return XHPChild\anyOf(XHPChild\pcdata(), XHPChild\category('%phrase'), );
  }


  protected function render(): \XHPRoot {
    return <x:frag>{$this->getChildren('%phrase')}</x:frag>;
  }
}
