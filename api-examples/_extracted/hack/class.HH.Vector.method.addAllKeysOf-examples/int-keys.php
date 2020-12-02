<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHVectorMethodAddAllKeysOf\IntKeys;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $uploaders_by_id = Map {
    4993063 => 'Amy Smith',
    9361760 => 'John Doe',
  };

  $commenters_by_id = darray[
    7424854 => 'Jane Roe',
    5740542 => 'Joe Bloggs',
  ];

  $all_ids = Vector {};

  // Add the keys from a Map
  $all_ids->addAllKeysOf($uploaders_by_id);

  // Add the keys from an associative array
  $all_ids->addAllKeysOf($commenters_by_id);

  \var_dump($all_ids);
}
