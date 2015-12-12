<?hh // strict

namespace HHVM\UserDocumentation;

use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlock\Tag;

final class ClassMarkdownBuilder {
  private ClassYAML $yaml;
  private ?DocBlock $docblock;
  private DocblockTagReader $tagReader;

  public function __construct(
    string $file,
  ) {
    $this->yaml = \Spyc::YAMLLoad($file);
    $doc = $this->yaml['data']['docComment'];
    if ($doc !== null) {
      $this->docblock = new DocBlock($doc);
    }
    $this->tagReader = DocblockTagReader::newFromObject($this->docblock);
  }

  public function build(): void {
    $md = $this->getMarkdown();
    $filename = self::getOutputFileName(
      APIDefinitionType::assert($this->yaml['type']),
      $this->yaml['data'],
    );
    file_put_contents($filename, $md);
  }

  public static function getOutputFileName(
    APIDefinitionType $type,
    ClassDocumentation $docs,
  ): string {
    return sprintf(
      '%s/%s.%s.md',
      BuildPaths::APIDOCS_MARKDOWN,
      $type,
      strtr($docs['name'], "\\", '.'),
    );
  }

  public function getMarkdown(): string {
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
    return '## The '.htmlspecialchars($this->getName()).' '.$this->yaml['type'];
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
    $guides = $this->tagReader
      ->getTagsByName('guide')
      ->map($tag ==> $tag->getContent());
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
    $md = "### Interface synopsis\n";

    // Display the class signature, including any namespace.
    $csig = '';
    if ($this->yaml['data']['namespace'] !== '') {
      $csig .= 'namespace ' . $this->yaml['data']['namespace'] . " {\n  ";
    }
    $csig .= $this->yaml['type'] . ' ' . $this->yaml['data']['shortName'];
    if ($this->yaml['data']['parent'] !== null) {
      $csig .= 'extends ' . $this->yaml['data']['parent']['shortName'] . ' ';
    }
    foreach ($this->yaml['data']['interfaces'] as $interface) {
      $csig .= 'implements ' . $interface['shortName'] . "\n";
    }
    $csig .= "{ ... }\n";

    $md .=
      '<code class="interfaceSignature">'.
      $csig.
      '</code>';

    $methods = $this->yaml['data']['methods'];

    foreach ($methods as $method) {
      $method_url = URLBuilder::getPathForMethod($method);

      if ($method['static']) {
        $name = '::';
      } else {
        $name = '->';
      }
      $name .= self::nameFromData($method).'()';

      $md .=
        ' * [`'.$name.'`]('. $method_url .') ';

      $ret_type = $method['returnType'];
      $md .=
        '<code class="methodSignature">'.
        Stringify::signature($method, StringifyFormat::ONE_LINE).
        '</code>';


      $comment = $method['docComment'];
      if ($comment !== null) {
        $desc = (new DocBlock($comment))->getShortDescription();
        if ($desc !== "") {
          $md .= '<br />'.$desc;
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
      $name .= '<'.implode(',', $generics).'>';
    }
    return $name;
  }
}
