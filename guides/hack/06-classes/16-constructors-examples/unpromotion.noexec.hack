// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Classes\Constructors\Unpromotion;

final class User {
  private ParsedName $name;

  public function __construct(
    private int $id,
    string $name,
  ) {
    $this->name = parse_name($name);
  }
}
