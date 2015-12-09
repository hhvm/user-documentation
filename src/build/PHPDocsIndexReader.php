<?hh // strict

namespace HHVM\UserDocumentation;

final class PHPDocsIndexReader {
  private Map<string, string> $classes = Map { };
  private Map<string, string> $functions = Map { };
  private Map<string, string> $methods = Map { };
  private Map<string, string> $articles = Map { };

  public function __construct(
    string $content,
  ) {
    $article_types = Set {
      'book',
      'chapter',
      'preface',
      'reference',
      'section',
      'sect1',
    };

    $old_index = json_decode($content);

    foreach ($old_index as $entry) {
      list ($name, $id, $type) = $entry;

      $name = html_entity_decode($name);

      if ($type === 'phpdoc:classref') {
        $name = explode('<', $name)[0]; // remove generics
        $this->classes[$name] = $id;
        continue;
      }

      if ($article_types->contains($type)) {
        $this->articles[$id] = $id;
        continue;
      }

      if ($type !== 'refentry') {
        continue;
      }
      $parts = (new Vector(explode('::', $name)))
        ->map($x ==> explode('<', $x)[0]);

      if (count($parts) === 1) {
        $this->functions[$parts[0]] = $id;
        continue;
      }

      invariant(
        count($parts) === 2,
        "Definition %s has %d parts",
        $name,
        count($parts),
      );
      $this->methods[implode('::', $parts)] = $id;
    }
  }

  public function getClasses(): ImmMap<string, string> {
    return $this->classes->toImmMap();
  }

  public function getFunctions(): ImmMap<string, string> {
    return $this->functions->toImmMap();
  }

  public function getMethods(): ImmMap<string, string> {
    return $this->methods->toImmMap();
  }

  public function getAllAPIDefinitions(): ImmMap<string, string> {
    $defs = Map { };
    $defs->setAll($this->getClasses());
    $defs->setAll($this->getMethods());
    $defs->setAll($this->getFunctions());
    return $defs->toImmMap();
  }

  public function getArticles(): ImmMap<string, string> {
    $defs = $this->classes->values()->toSet();
    $defs->addAll($this->functions->values());
    $defs->addAll($this->methods->values());

    return $this->articles->filter($x ==> !$defs->contains($x))->toImmMap();
  }
}
