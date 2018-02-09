<?hh

namespace Hack\UserDocumentation\Callables\SpecialFunctions\Examples\Lambda;

class Foo {
  public function __construct(
    private string $content,
  ) {
  }

  public function getContent(): string {
    return $this->content;
  }
}

function main() {
  $in = Vector {
    new Foo('herp'),
    new Foo('derp'),
  };

  $out = $in->map($foo ==> $foo->getContent());
  \var_dump($out);
}

main();
