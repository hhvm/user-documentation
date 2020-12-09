<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\FunctionHHAsioMfk\BasicUsage;

enum COLOR: int {
  RED = 1;
  ORANGE = 2;
  YELLOW = 3;
  GREEN = 4;
  BLUE = 5;
  INDIGO = 6;
  VIOLET = 7;
}

<<__EntryPoint>>
async function basic_usage_main(): Awaitable<void> {
  \init_docs_autoloader();

  $fruits = ImmMap {
    'Apple' => COLOR::RED,
    'Banana' => COLOR::YELLOW,
    'Grape' => COLOR::GREEN,
    'Orange' => COLOR::ORANGE,
    'Pineapple' => COLOR::YELLOW,
    'Tangerine' => COLOR::ORANGE,
  };

  // Similar to $times->filter(...)
  // But awaits the awaitable result of the callback
  // rather than using it directly
  $not_self_named = await \HH\Asio\mfk(
    $fruits,

    // Exclude fruits who's name is the same as their color
    async ($name, $color) ==> \strcasecmp($name, COLOR::getNames()[$color]),
  );

  foreach ($not_self_named as $fruit => $color) {
    echo $fruit, 's are ', COLOR::getNames()[$color], "\n";
  }
}
