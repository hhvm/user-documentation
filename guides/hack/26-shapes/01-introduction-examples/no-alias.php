<?hh

namespace Hack\UserDocumentation\Shapes\Intro\Examples\Anonymous;

class C {

  public function __construct(
    private shape('real' => float, 'imag' => float) $prop) {}

  public function setProp(shape('real' => float, 'imag' => float) $val): void {
    $this->prop = shape('real' => $val['real'], 'imag' => $val['imag']);
  }

  public function getProp(): shape('real' => float, 'imag' => float) {
    return $this->prop;
  }
}

function main(): void {
  $c = new C(shape('real' => -2.5, 'imag' => 1.3));
  \var_dump($c);
  $c->setProp(shape('real' => 2.0, 'imag' => 99.3));
  \var_dump($c->getProp());
}

main();
