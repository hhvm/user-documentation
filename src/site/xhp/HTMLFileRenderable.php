<?hh // strict

namespace HHVM\UserDocumentation;

class HTMLFileRenderable implements \XHPUnsafeRenderable {
  public function __construct(
    private string $htmlFile,
    private string $htmlRoot = BuildPaths::GUIDES_HTML,
  ) {
    invariant(file_exists($htmlFile), 'html file does not exist');
    
    $root = realpath($htmlRoot).'/';
    
    invariant(
      (substr(realpath($htmlFile), 0, strlen($root)) === $root),
      'html file %s is not a build artifact',
      $htmlFile,
    );
  }

  public function toHTMLString(): string {
    return file_get_contents($this->htmlFile);
  }
}
