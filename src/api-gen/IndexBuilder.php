<?hh // strict

namespace HHVM\UserDocumentation;

class IndexBuilder {
  private Vector<string> $sourceFiles = Vector { };

  public function addSources(
    \ConstVector<string> $sources,
  ): this {
    $this->sourceFiles->addAll($sources);
    return $this;
  }

  public function buildIndex(): DocumentationIndex {
    $types = [];
    $type_types = Set { 'class', 'interface', 'trait' };

    foreach ($this->sourceFiles as $file) {
      $source = /* UNSAFE_EXPR spyc isn't hack */ \Spyc::YAMLLoad($file);
      $type = $source['type'];
      if (!$type_types->contains($type)) {
        continue;
      }
      $data = $source['data'];
      $name = $data['name'];
   
      $types[$name] = shape(
        'path' => $file,
        'name' => $name,
        'type' => $type,
      );
    }
    return shape('types' => $types);
  }
}
