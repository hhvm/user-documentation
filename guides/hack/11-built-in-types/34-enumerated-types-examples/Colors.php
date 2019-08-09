<?hh // strict

namespace Hack\UserDocumentation\Types\Enums\Examples\Colors;

enum Colors: int {
  Red = 3;
  White = 5;
  Blue = 10;
  Default = 3; // duplicate value is okay
}
