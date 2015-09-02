<?hh

namespace HHVM\UserDocumentation;

use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlock\ParamTag;
use phpDocumentor\Reflection\DocBlock\Tag;

class FunctionMarkdownBuilder {
  private FunctionYAML $yaml;
  private ?DocBlock $docblock;

  public function __construct(
    string $file,
  ) {
    $this->yaml = \Spyc::YAMLLoad($file);

    $comment = $this->yaml['data']['docComment'];
    if ($comment !== null) {
      $this->docblock = new DocBlock($comment);
    }
  }

  public function build(): string {
    return implode(
      "\n\n",
      [
        $this->getHeading(),
        $this->getDescription(),
        $this->getParameters(),
      ],
    )."\n";
  }

  private function getHeading(): string {
    $name = $this->yaml['data']['name'];
    $md = $name."\n".str_repeat('=', strlen($name))."\n\n";

    $md .= $this->docblock?->getShortDescription();
    return $md;
  }

  private function getDescription(): string {
    $md = 'Description';
    $md .= "\n".str_repeat('-', strlen($md))."\n\n";

    $md .= "```Hack\n".$this->getSignature()."\n```\n\n";

    $md .= $this->docblock?->getText();

    return $md;
  }

  private function getParameters(): string {
    $tags = $this->getTagsByName('param', ParamTag::class);

    $md = 'Parameters';
    $md .= "\n".str_repeat('-', strlen($md))."\n\n";

    foreach ($this->yaml['data']['parameters'] as $param) {
      $name = $param['name'];
      $tag = idx($tags, $name);

      $md .= '- `'.Stringify::parameter($param, $tag).'`';
      if ($tag) {
        $md .= ' - '.$tag->getDescription();
      }
      $md .= "\n";
    }
    return $md;
  }

  private function getSignature(): string {
    $tags = $this->getTagsByName('param', ParamTag::class);

    $params = array_map(
      $param ==> Stringify::parameter($param, idx($tags, $param['name'])),
      $this->yaml['data']['parameters'],
    );
    return sprintf(
      "function %s(%s): %s",
      $this->yaml['data']['name'],
      implode(', ', $params),
      Stringify::typehint(
        ArgAssert::isNotNull($this->yaml['data']['returnType']),
      ),
    );
  }

  <<__Memoize>>
  private function getTagsByName<T as Tag>(
    string $name,
    classname<T> $type = Tag::class,
  ): Map<string,T> {
    $tags = Map { };
    $raw_tags = $this->docblock?->getTagsByName($name);
    if ($raw_tags !== null) {
      foreach ($tags as $tag) {
        invariant(
          $tag instanceof $type,
          'Expected %s tags to be %s, got %s',
          $name,
          $type,
          get_class($tag),
        );
        $tags[$tag->getVariableName()] = $tag;
      }
    }
    return $tags;
  }
}
