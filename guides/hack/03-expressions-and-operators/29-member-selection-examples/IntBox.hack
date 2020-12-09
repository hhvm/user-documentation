<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ExpressionsAndOperators\MemberSelection\IntBox;

class IntBox {
  private int $x;

  public function __construct(int $x) {
    $this->x = $x; // Assigning to property.
  }

  public function getX(): int {
    return $this->x; // Accessing property.
  }
}

<<__EntryPoint>>
function main(): void {
  \init_docs_autoloader();

  $ib = new IntBox(42);
  $x = $ib->getX(); // Calling instance method.
}
