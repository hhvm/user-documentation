// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Classes\TypeConstantsRevisited\Instance;

abstract class Box {
  abstract const type T;
  public function __construct(private this::T $value) {}
  public function get(): this::T {
    return $this->value;
  }
  public function set(this::T $val): this {
    $this->value = $val;
    return $this;
  }
}

class IntBox extends Box {
  const type T = int;
}

<<__EntryPoint>>
function run(): void {
  \init_docs_autoloader();

  $ibox = new IntBox(10);
  \var_dump($ibox);
  $ibox->set(123);
  \var_dump($ibox);
}
