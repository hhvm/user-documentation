<?hh // strict

namespace HHVM\UserDocumentation;

enum DocumentationSourceType: string {
  FILE = 'file';
  ELF_SECTION = 'elf_section';
};

enum ClassType: string {
  BASIC_CLASS = 'class';
  INTERFACE_CLASS = 'interface';
  TRAIT_CLASS = 'trait';
}

type DocumentationSource = shape(
  'type' => DocumentationSourceType,
  'name' => string,
  'mtime' => int,
);

type ClassDocumentation = shape(
  'name' => string,
  'type' => ClassType,
  'methods' => array<string>,
);

type DocumentationBundle = shape(
  'source' => DocumentationSource,
  'classes' => array<ClassDocumentation>,
);
