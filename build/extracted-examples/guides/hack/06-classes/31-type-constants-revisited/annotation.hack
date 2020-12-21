// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Classes\TypeConstantsRevisited\Annotation;

abstract class Base {
  abstract const type T;
  protected this::T $value;
}

class Stringy extends Base {
  const type T = string;
  public function __construct() {
    // inherits $value in Base which is now setting T as a string
    $this->value = "Hi";
  }
  public function getString(): string {
    return $this->value; // property of type string
  }
}

class Inty extends Base {
  const type T = int;
  public function __construct() {
    // inherits $value in Base which is now setting T as an int
    $this->value = 4;
  }
  public function getInt(): int {
    return $this->value; // property of type int
  }
}

<<__EntryPoint>>
function run(): void {
  \init_docs_autoloader();

  $s = new Stringy();
  $i = new Inty();
  \var_dump($s->getString());
  \var_dump($i->getInt());
}
