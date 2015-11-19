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

enum GuidesProduct: string as string {
  HHVM = 'hhvm';
  HACK = 'hack';
}

enum APIDefinitionType: string as string {
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
  'type' => APIDefinitionType,
  'methods' => array<MethodDocumentation>,
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
  'className' => ?string,
  'classType' => ?APIDefinitionType,
  'visibility' => ?MemberVisibility,
  'static' => ?bool,
);

type MethodDocumentation = shape(
  'name' => string,
  'returnType' => ?TypehintDocumentation,
  'generics' => array<GenericDocumentation>,
  'docComment' => ?string,
  'parameters' => array<ParameterDocumentation>,
  'className' => string,
  'classType' => APIDefinitionType,
  'visibility' => MemberVisibility,
  'static' => bool,
);

type DocumentationIndexEntry = shape(
  'path' => string,
  'name' => string,
  'type' => string,
);

type DocumentationIndex = shape(
  'types' => array<string,DocumentationIndexEntry>,
);

type APIIndexEntry = shape(
  'name' => string,
  'htmlPath' => string,
  'urlPath' => string,
);

type APIFunctionIndexEntry = shape(
  'name' => string,
  'htmlPath' => string,
  'urlPath' => string,
);

type APIMethodIndexEntry = shape(
  'name' => string,
  'className' => string,
  'classType' => APIDefinitionType,
  'htmlPath' => string,
  'urlPath' => string,
);

type APIClassIndexEntry = shape(
  'type' => APIDefinitionType,
  'name' => string,
  'htmlPath' => string,
  'urlPath' => string,
  'methods' => array<string, APIMethodIndexEntry>,
);

type APIIndexShape = shape(
  'class' => array<string, APIClassIndexEntry>,
  'interface' => array<string, APIClassIndexEntry>,
  'trait' => array<string, APIClassIndexEntry>,
  'function' => array<string, APIFunctionIndexEntry>,
);

type StaticResourceMapEntry = shape(
  'localPath' => string,
  'checksum' => string,
  'mtime' => int,
  'mimeType' => string,
);

type NavDataNode = shape(
  'urlPath' => string,
  /*
   * This is actually array<string, NavDataNode> but recursive shapes aren't
   * allowed. Given we only read this from JS, not a big deal, just be careful
   * writing it.
   */
  'children' => array<string, mixed>,
);

type PaginationDataNode = shape(
  'page' => array<?string, mixed>,
  'guide' => array<?string, mixed>,
);
