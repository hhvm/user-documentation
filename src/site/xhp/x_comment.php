<?hh // strict

class :x:comment extends :x:primitive implements XHPAlwaysValidChild {
  children (pcdata*);

  protected function stringify(): string {
    $html = '<!--';
    foreach ($this->getChildren() as $child) {
      $html .= htmlspecialchars($child);
    }
    $html .= '-->';
    return $html;
  }
}
