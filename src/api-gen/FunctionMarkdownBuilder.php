<?hh

namespace HHVM\UserDocumentation;

use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlock\Tag\ParamTag;
use phpDocumentor\Reflection\DocBlock\Tag;

class FunctionMarkdownBuilder {
  private FunctionYAML $yaml;
  private ?DocBlock $docblock;

  public function __construct(
    ?string $file = null,
    ?FunctionDocumentation $method = null,
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

    $md .= "```Hack\n".$this->getSignature()."\n```\n\n";

    $md .= $this->docblock?->getText();

    return $md;
  }

  private function getParameters(): string {
    $tags = $this->getTagsByName('param', ParamTag::class);

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

  private function getSignature(): string {
    $tags = $this->getTagsByName('param', ParamTag::class);

    $params = array_map(
      $param ==> Stringify::parameter($param, idx($tags, $param['name'])),
      $this->yaml['data']['parameters'],
    );
    $return_type = $this->yaml['data']['returnType'];
    if ($return_type === null) {
      // TODO: log warning for this once we have a good logging system
      return sprintf(
        "function %s(%s)",
        $this->yaml['data']['name'],
        implode(', ', $params),
      );
    }

    return sprintf(
      "function %s(%s): %s",
      $this->yaml['data']['name'],
      implode(', ', $params),
      Stringify::typehint($return_type),
    );
  }

  <<__Memoize>>
  private function getTagsByName<T as Tag>(
    string $name,
    classname<T> $type = Tag::class,
  ): Map<string,T> {
    $tags = Map {};
    // If $this->docblock is null, passing null to Map constructor returns
    // empty map
    $raw_tags = new Map($this->docblock?->getTagsByName($name));
    foreach ($raw_tags as $tag) {
      invariant(
        $tag instanceof $type,
        'Expected %s tags to be %s, got %s',
        $name,
        $type,
        get_class($tag),
      );
      $tags[$tag->getVariableName()] = $tag;
    }
    return $tags;
  }
}
