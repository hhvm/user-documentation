<?hh // strict

namespace HHVM\UserDocumentation;

use FredEmmott\DefinitionFinder\ScannedBase;

type ScannedDefinitionFilter = (function(ScannedBase): bool);

enum DocumentationSourceType: string {
  FILE = 'file';
  ELF_SECTION = 'elf_section';
};

type DocumentationSource = shape(
  'type' => DocumentationSourceType,
  'name' => string,
  'mtime' => int,
);

type BaseYAML = shape(
  'sources' => array<DocumentationSource>,
  'type' => string,
  'data' => shape('name' => string),
);

type ClassDocumentation = shape(
  'name' => string,
  'methods' => array<FunctionDocumentation>,
  'generics' => array<GenericDocumentation>,
  'docComment' => ?string,
);

type TypehintDocumentation = shape(
  'typename' => string,
  'genericTypes' => array<mixed /* cyclic: TypehintDocumentation*/>,
);

type GenericDocumentation = shape(
  'name' => string,
  'constraint' => ?string,
);

type FunctionDocumentation = shape(
  'name' => string,
  'returnType' => ?TypehintDocumentation,
  'generics' => array<GenericDocumentation>,
  'docComment' => ?string,
);
