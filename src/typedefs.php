<?hh // strict

namespace HHVM\UserDocumentation;

use FredEmmott\DefinitionFinder\ScannedBase;

type ScannedDefinitionFilter = (function(ScannedBase): bool);

type DocumentedAPIDefinitionName = string;
type SiteURLPath = string;

enum DocumentationSourceType: string {
  FILE = 'file';
  ELF_SECTION = 'elf_section';
};

enum MemberVisibility: string {
  PRIVATE = 'private';
  PROTECTED = 'protected';
  PUBLIC = 'public';
};

enum APIDefinitionType: string {
  CLASS_DEF = 'class';
  TRAIT_DEF = 'trait';
  INTERFACE_DEF = 'interface';
  FUNCTION_DEF = 'function';
}

enum GuideDefinitionType: string {
    HHVM_DEF = 'hhvm';
    HACK_DEF = 'hack';
}

type DocumentationSource = shape(
  'type' => DocumentationSourceType,
  'name' => string,
  'mtime' => int,
);

type BaseYAML = shape(
  'sources' => array<DocumentationSource>,
  'type' => APIDefinitionType,
  'data' => shape('name' => string),
);

type ClassYAML = shape(
  'sources' => array<DocumentationSource>,
  'type' => APIDefinitionType,
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
  'visibility' => ?MemberVisibility,
  'static' => ?bool,
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
  'methods' => array<string, string>,
);

type APIIndexShape = shape(
  'class' => array<string, APIClassIndexEntry>,
  'interface' => array<string, APIClassIndexEntry>,
  'trait' => array<string, APIClassIndexEntry>,
  'function' => array<string, APIClassIndexEntry>,
);
