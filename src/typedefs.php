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

type ClassYAML = shape(
  'sources' => array<DocumentationSource>,
  'type' => string,
  'data' => ClassDocumentation,
);

type FunctionYAML = shape(
  'sources' => array<DocumentationSource>,
  'data' => FunctionDocumentation,
);

type ClassDocumentation = shape(
  'name' => string,
  'methods' => array<FunctionDocumentation>,
  'generics' => array<GenericDocumentation>,
  'docComment' => ?string,
  'parent' => ?TypehintDocumentation,
  'interfaces' => array<TypehintDocumentation>,
);

type TypehintDocumentation = shape(
  'typename' => string,
  'genericTypes' => array<mixed /* cyclic: TypehintDocumentation*/>,
);

type GenericDocumentation = shape(
  'name' => string,
  'constraint' => ?string,
);

type ParameterDocumentation = shape(
  'name' => string,
  'typehint' => ?TypehintDocumentation,
  'isVariadic' => bool,
  'isPassedByReference' => bool,
  'isOptional' => bool,
  'default' => ?string,
);

type FunctionDocumentation = shape(
  'name' => string,
  'returnType' => ?TypehintDocumentation,
  'generics' => array<GenericDocumentation>,
  'docComment' => ?string,
  'parameters' => array<ParameterDocumentation>,
);

type DocumentationIndexEntry = shape(
  'path' => string,
  'name' => string,
  'type' => string,
);

type DocumentationIndex = shape(
  'types' => array<string,DocumentationIndexEntry>,
);

type APIClassIndexEntry = shape(
  'path' => string,
  'methods' => Map<string, string>,
);
