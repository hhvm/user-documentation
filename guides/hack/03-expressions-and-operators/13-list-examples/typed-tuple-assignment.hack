// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ExpressionsAndOperators\List\TypedTupleAssignment;

<<__EntryPoint>>
function main(): void {
  \init_docs_autoloader();

  $tuple = tuple('string', 1, false);
  list($string, $int, $bool) = $tuple;
  takes_string($string);
  takes_int($int);
  takes_bool($bool);
  echo 'The typechecker understands the types of list().';
}

function takes_string(string $_): void {}
function takes_int(int $_): void {}
function takes_bool(bool $_): void {}
