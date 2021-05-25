<?hh // strict
/*
 *  Copyright (c) 2004-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the BSD-style license found in the
 *  LICENSE file in the root directory of this source tree. An additional grant
 *  of patent rights can be found in the PATENTS file in the same directory.
 *
 */

namespace HHVM\UserDocumentation;

type DirectoryIndex = shape(
  'files' => Traversable<string>,
);

type YAMLMeta = shape(
  ?'name' => string,
  ?'sources' => vec<string>,
  ?'class' => string,
  ?'lib' => shape(
    'name' => string,
    'github' => string,
    'composer' => string,
  ),
  ?'fbonly messages' => vec<string>,
  ?'min-versions' => dict<RequirableProduct, string>,
  ?'experimental' => bool,
  ?'namespace' => string,
);

enum CategoriesHack: string as string {
  CLASSES_INTERFACES_TRAITS = 'Classes, Interfaces, Traits';
  CONTROL_FLOW = 'Control Flow';
  GETTING_STARTED = 'Getting Started';
  TYPES_GENERICS = 'Types and Generics';
}

enum CategoriesHHVM: string as string {
  LEARN = 'Learn';
}

enum DocumentationSourceType: string {
  FILE = 'file';
  ELF_SECTION = 'elf_section';
}

enum GuidesProduct: string as string {
  HHVM = 'hhvm';
  HACK = 'hack';
}

enum RequirableProduct: string as string {
  HHVM = 'HHVM';
  HSL = 'HSL';
}

enum UIGlyphIcon: string {
  BUG = 'bug';
  LEFT = 'angle-double-left fa-2x';
  RIGHT = 'angle-double-right fa-2x';
  SEARCH = 'search';
  LIST = "th-list";
}

enum APIDefinitionType: string as string {
  CLASS_DEF = 'class';
  TRAIT_DEF = 'trait';
  INTERFACE_DEF = 'interface';
  FUNCTION_DEF = 'function';
}

enum APIProduct: string as string {
  HACK = 'hack';
  HSL = 'hsl';
  HSL_EXPERIMENTAL = 'hsl-experimental';
}

type DocumentationSource = shape(
  'type' => DocumentationSourceType,
  'name' => string,
  'mtime' => int,
);

type BaseYAML = shape(
  'sources' => vec<DocumentationSource>,
  'type' => APIDefinitionType,
  'data' => shape('name' => string, ...),
);

type APIIndexEntry = shape(
  'name' => string,
  'htmlPath' => string,
  'urlPath' => string,
  ?'methods' => dict<string, APIMethodIndexEntry>,
  ...
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
  'methods' => dict<string, APIMethodIndexEntry>,
);

type ProductAPIIndexShape = shape(
  'class' => dict<string, APIClassIndexEntry>,
  'interface' => dict<string, APIClassIndexEntry>,
  'trait' => dict<string, APIClassIndexEntry>,
  'function' => dict<string, APIFunctionIndexEntry>,
);

type APIIndexShape = shape(
  APIProduct::HACK => ProductAPIIndexShape,
  APIProduct::HSL => ProductAPIIndexShape,
  APIProduct::HSL_EXPERIMENTAL => ProductAPIIndexShape,
);

type StaticResourceMapEntry = shape(
  'localPath' => string,
  'checksum' => string,
  'mtime' => int,
  'mimeType' => string,
);

/** An enforceable supertype of `NavDataNode`.
 *
 * Use `NavDataNode` instead if possible.
 */
type NavDataNodeIsh = shape(
  'name' => string,
  'urlPath' => string,
  /** actually `dict<string, NavDataNode>`, or `dict<string, NavDataNodeIsh>`,
   * but:
   * - recursive types aren't allowed
   * - dicts aren't enforceable as they have erased generics
   */
  'children' => mixed,
);

type NavDataNode = shape(
  'name' => string,
  'urlPath' => string,
  /*
   * This is actually dict<string, NavDataNode> but recursive shapes aren't
   * allowed. Given we only read this from JS, not a big deal, just be careful
   * writing it.
   */
  'children' => dict<string, NavDataNodeIsh>,
);

type PaginationDataNode = shape(
  'page' => (string, NavDataNodeIsh),
  'guide' => (string, NavDataNodeIsh),
);
