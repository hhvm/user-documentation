<?hh

namespace Hack\UserDocumentation\Enums\Intro\Examples\MemberValues;

enum Size: string {
  SMALL = "small" ;
  MEDIUM = "medium";
  LARGE = "large";
  X_LARGE = "x-large";
}

function say_all_sizes(): void {
  echo Size::SMALL . PHP_EOL . Size::MEDIUM . PHP_EOL .
       Size::LARGE . PHP_EOL . Size::X_LARGE;
}

say_all_sizes();
