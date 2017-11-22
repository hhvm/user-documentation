<?hh // strict

namespace HHVM\UserDocumentation;

final class ClassMarkdownBuilder {
  private ClassYAML $yaml;
  private DocBlock $docblock;

  public function __construct(
    private APIProduct $product,
    string $file,
  ) {
    $this->yaml = JSON\decode_as_shape(
      ClassYAML::class,
      file_get_contents($file),
    );
    $doc = $this->yaml['data']['docComment'];
    $this->docblock = new DocBlock($doc ?? '');
  }

  public function build(): string {
    $md = $this->getMarkdown();
    $filename = self::getOutputFileName(
      $this->product,
      APIDefinitionType::assert($this->yaml['type']),
      $this->yaml['data'],
    );
    \file_put_contents($filename, $md);
    return $filename;
  }

  public static function getOutputFileName(
    APIProduct $product,
    APIDefinitionType $type,
    ClassDocumentation $docs,
  ): string {
    return sprintf(
      '%s/%s/%s.%s.md',
      BuildPaths::APIDOCS_MARKDOWN,
      $product,
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
      $desc = $this->docblock->getDescription();
      if ($desc !== null && strpos($desc, 'Copyright (c)') !== 0) {
        $md .= $desc . "\n";
      }
    }
    return $md;
  }

  private function getGuides(): ?string {
    $guides = $this->docblock->getTagsByName('guide');
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

    $md .=
      '<code class="code">'.
      Stringify::interfaceSignature($this->yaml['data']).
      '</code>';
    $md .= "\n";

    $methods = $this->yaml['data']['methods'];

    foreach ($methods as $method) {
      $method_url = URLBuilder::getPathForMethod($this->product, $method);

      if ($method['static']) {
        $name = '::';
      } else {
        $name = '->';
      }
      $name .= $method['name'];
      $generics = htmlspecialchars(
        Stringify::generics($method['generics'])
      );
      $params = htmlspecialchars(
        Stringify::parameters($method, StringifyFormat::ONE_LINE)
      );
      $return_type = $method['returnType'];
      $return_type =
        $return_type === null
        ? ''
        : ': '.htmlspecialchars(Stringify::typehint($return_type));

      $md .=
        ' * [`'.
        $name.
        '`<code class="methodListSignature">'.
        $generics.$params.$return_type.
        '</span>]('.$method_url.') ';

      $comment = $method['docComment'];
      if ($comment !== null) {
        $desc = (new DocBlock($comment))->getSummary();
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
    shape(
      'name' => string,
      'generics' => array<GenericDocumentation>,
      ...
    ) $data,
  ): string {
    $name = $data['name'];
    $name .= Stringify::generics($data['generics']);
    return $name;
  }
}
