<?hh // strict

namespace HHVM\UserDocumentation;

use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlock\Tag\ParamTag;
use phpDocumentor\Reflection\DocBlock\Tag\ReturnTag;
use phpDocumentor\Reflection\DocBlock\Tag;

final class FunctionMarkdownBuilder {
  use DocblockTagReader;

  private FunctionYAML $yaml;
  protected ?DocBlock $docblock;

  public function __construct(
      string $file,
      ?FunctionDocumentation $method = null,
      private ?string $class = null,
      ) {
    $this->yaml = \Spyc::YAMLLoad($file);
    if ($method) {
      $this->yaml['data'] = $method;
    }

    $comment = $this->yaml['data']['docComment'];
    if ($comment !== null) {
      $this->docblock = new DocBlock($comment);
    }
  }

  public function build(): void {
    $md = $this->getMarkdown();
    $filename = self::getOutputFileName($this->yaml['data']);
    file_put_contents($filename, $md);
  }

  public function getMarkdown(): string {
    return implode(
      "\n\n",
      [
        $this->getHeading(),
        $this->getDescription(),
        $this->getParameters(),
        $this->getReturnValues(),
        $this->getExamples(),
      ],
    )."\n";
  }

  public static function getOutputFileName(
    FunctionDocumentation $docs,
  ): string {
    return sprintf(
      '%s/function.%s.md',
      BuildPaths::APIDOCS_MARKDOWN,
      strtr($docs['name'], "\\", '.'),
    );
  }

  private function getHeading(): ?string {
    if (
        $this->docblock?->getText() !== $this->docblock?->getShortDescription()
       ) {
      return $this->docblock?->getShortDescription();
    }
    return null;
  }

  private function getDescription(): string {
    $md = "### Description\n\n";

    $md .= "```Hack\n<?hh\n".$this->getSignature()."\n```\n\n";

    $md .= $this->docblock?->getText();

    return $md;
  }

  private function getParameters(): ?string {

    // If no parameters for the function, then move on
    if (count($this->yaml['data']['parameters']) === 0) {
      return null;
    }

    $tags = $this->getParamTags();

    $md = "### Parameters\n\n";

    foreach ($this->yaml['data']['parameters'] as $param) {
      $name = $param['name'];

      // The keys in the $tags map are actually the parameter names with the
      // $. Why? I don't know.
      $tag = idx($tags, '$'.$name);

      $md .= '- `'.Stringify::parameter($param, $tag).'`';
      if ($tag) {
        // The '-' is generally included in the description. We can do something
        // more fancy if we need to, like `: ` and a preg_match on the first
        // position of a alphnumeric character, thus getting rid of any '-'
        $md .= ' '.$tag->getDescription();
      }
      $md .= "\n";
    }
    return $md;
  }

  private function getReturnValues(): ?string {
    $tags = $this->getTypedTagsByName('return', ReturnTag::class);
    if (!$tags) {
      return null;
    }

    $ret = "### Return Values\n";
    foreach ($tags as $tag) {
      $ret .= "\n - ";
      $types = $tag->getTypes();
      $types = array_filter($types, $type ==> $type !== '\-' && $type !== '-');
      if ($types) {
        $ret .= '`'.implode('|', $types).'` - ';
      } else {
        $ret_th = $this->yaml['data']['returnType'];
        if ($ret_th !== null) {
          $ret .= '`'.Stringify::typehint($ret_th).'` - ';
        }
      }

      $ret .= $tag->getDescription();
    }
    return $ret;
  }

  private function getSignature(): string {
    $ret = '';

    $visibility = $this->yaml['data']['visibility'];
    if ($visibility !== null) {
      $ret .= $visibility.' ';
    }
    if ($this->yaml['data']['static'] === true) {
      $ret .= 'static ';
    }
    $ret .= 'function '.$this->yaml['data']['name'];

    $tags = $this->getParamTags();
    $params = array_map(
      $param ==> Stringify::parameter($param, idx($tags, $param['name'])),
      $this->yaml['data']['parameters'],
    );
    if (!$params) {
      $ret .= '()';
    } else {
      $ret .= "(\n".implode("\n", array_map($x ==> '  '.$x.',', $params))."\n)";
    }

    $return_type = $this->yaml['data']['returnType'];
    if ($return_type !== null) {
      $ret .= ': '.Stringify::typehint($return_type);
    }

    return $ret;
  }

  private function getExamples(): ?string {
    $path = LocalConfig::ROOT.'/api-examples/';

    if ($this->class === null) {
      $path .= 'function.';
    } else {
      $path .= 'class.'.$this->class.'/';
    }

    $path .= $this->yaml['data']['name'];
    $path = strtr($path, "\\", '.');
    $examples = (new Vector(glob($path.'/*.php')))
      ->addAll(glob($path.'/*.md'))
      ->map($filename ==> pathinfo($filename, PATHINFO_FILENAME))
      ->toSet()
      ->toVector(); // Work around issue that Sets can't be sorted

    if (count($examples) === 0) {
      return null;
    }
    sort($examples);

    $ret = "### Examples\n";
    foreach ($examples as $example) {
      $preamble = $path.'/'.$example.'.md';
      $code = $path.'/'.$example.'.php';
      if (file_exists($preamble)) {
        $ret .= "\n\n".file_get_contents($preamble);
      }
      if (file_exists($code)) {
        $ret .= "\n\n@@ ".$code." @@";
      }
      $ret .= "\n\n";
    }
    return $ret;
  }

  private function getParamTags(): Map<string, ParamTag> {
    $tags_vec = $this->getTypedTagsByName('param', ParamTag::class);
    $tags = Map { };
    foreach ($tags_vec as $tag) {
      $tags[$tag->getVariableName()] = $tag;
    }
    return $tags;
  }
}
