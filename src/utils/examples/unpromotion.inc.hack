// not relevant for the guide but needed for typechecking

namespace HHVM\UserDocumentation\Guides\Hack\Classes\Constructors\Unpromotion;

final class ParsedName {}

function parse_name(string $_name): ParsedName {
  return new ParsedName();
}
