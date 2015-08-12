<?hh // strict

namespace HHVM\UserDocumentation;

enum DocumentationSourceType: string {
  FILE = 'file';
  ELF_SECTION = 'elf_section';
};

type DocumentationSource = shape(
  'type' => DocumentationSourceType,
  'name' => string,
  'mtime' => int,
);

type ClassDocumentation = shape(
  'name' => string,
  'methods' => array<string>,
);

type DocumentationBundle = shape(
  'source' => DocumentationSource,
  'classes' => array<ClassDocumentation>,
  'interfaces' => array<ClassDocumentation>,
  'traits' => array<ClassDocumentation>,
);
