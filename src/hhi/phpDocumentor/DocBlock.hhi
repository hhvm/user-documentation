<?hh // decl

namespace phpDocumentor\Reflection;

class DocBlock {
  public function __construct(string $docBlock) {}

  public function getShortDescription(): string;
  public function getText(): string;

  public function getTagsByName(string $name): array<DocBlock\Tag>;
}
