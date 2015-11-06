<?hh

namespace HHVM\UserDocumentation;

use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlock\Tag;

class ClassMarkdownBuilder {
  use DocblockTagReader;

  private ClassYAML $yaml;
  protected ?DocBlock $docblock;

  public function __construct(
    string $file,
  ) {
    $this->yaml = \Spyc::YAMLLoad($file);
    $doc = $this->yaml['data']['docComment'];
    if ($doc !== null) {
      $this->docblock = new DocBlock($doc);
    }
  }

  public function build(): string {
    $parts = (Vector {
      $this->getHeading(),
      $this->getGuides(),
      $this->getDescription(),
      $this->getContents(),
    })->filter($x ==> $x !== null)
      ->map($x ==> trim($x));
    return implode("\n\n", $parts);
  }

  private function getHeading(): string {
    return '## The '.$this->getName().' '.$this->yaml['type'];
  }

  private function getDescription(): string {
    $md = "";
    if ($this->docblock !== null) {
      $desc = $this->docblock->getText();
      if ($desc !== "" && strpos($desc, 'Copyright (c)') !== 0) {
        $md .= $desc . "\n";
      }
    }
    return $md;
  }

  private function getGuides(): ?string {
    $guides = $this->getTagsByName('guide')->map($tag ==> $tag->getContent());
    if (!$guides) {
      return null;
    }

    $ret = <<<EOF
This page is a quick reference for people already familiar with the class. If
this is new to you, we strongly recommend reading the introductory guides first:

EOF;

    foreach ($guides as $url_path) {
      list($_, $product, $category, $page) = explode('/', $url_path);
      invariant(
        $product === 'hack',
        'can only link to hack guides - "%s" is referencing "%s"',
        $url_path,
        $product,
      );

      $title = ucwords(strtr($category.': '.$page, '-', ' '));

      $ret .= sprintf(
        " - [%s](%s)\n",
        $title,
        $url_path,
      );
    }

    $ret .= "\n---\n";

    return $ret;
  }

  private function getContents(): string {
    $prefix = $this->getName().'::';
    $md = "### Interface synopsis\n";
    foreach ($this->yaml['data']['methods'] as $method) {
      $method_url = sprintf(
        "/hack/reference/%s/%s/%s/",
        $this->yaml['type'],
        str_replace('\\', '.', $this->yaml['data']['name']),
        $method['name'],
      );
      $md .=
        ' * ['.$prefix.self::nameFromData($method).']('. $method_url .")";
      if ($method['docComment'] !== null) {
        $desc = (new DocBlock($method['docComment']))->getShortDescription();
        if ($desc !== "") {
          $md .= ': ' . $desc;
        }
      }
      $md .= "\n";
    }
    return $md;
  }

  <<__Memoize>>
  private function getName(): string {
    return self::nameFromData($this->yaml['data']);
  }

  private static function nameFromData(
    shape('name' => string, 'generics' => array<GenericDocumentation>) $data,
  ): string {
    $name = $data['name'];
    $generics = $data['generics'];
    if (count($generics) !== 0) {
      $generics = array_map(
        $generic ==> $generic['name'],
        $generics,
      );
      $name .= '&lt;'.implode(',', $generics).'&gt;';
    }
    return $name;
  }
}
