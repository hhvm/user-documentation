<?hh // strict

namespace HHVM\UserDocumentation;

class HTMLFileRenderable implements \XHPUnsafeRenderable {
  public function __construct(
    private string $htmlFile,
  ) {
    invariant(file_exists($htmlFile), 'html file does not exist');
    $root = realpath(BuildPaths::GUIDES_HTML).'/';
    invariant(
      substr(realpath($htmlFile), 0, strlen($root)) === $root,
      'html file %s is not a build artifact',
    );
  }

  public function toHTMLString(): string {
    return file_get_contents($this->htmlFile);
  }
}
