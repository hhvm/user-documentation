<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\FunctionHHAsioMfkw\BasicUsage;

<<__EntryPoint>>
async function basic_usage_main(): Awaitable<void> {
  \init_docs_autoloader();

  // Return all non-negative odd numbers
  // Positive evens filtered out,
  // Negatives and zero cause exception
  $odds = await \HH\Asio\mfkw(
    Map {
      '-one' => -1,
      'zero' => 0,
      'one' => 1,
      'two' => 2,
      'three' => 3,
      'four' => 4,
    },

    async ($num, $val) ==> {
      if ($val <= 0) {
        throw new \Exception("$num is non-positive");
      } else {
        return ($val % 2) == 1;
      }
    },
  );

  foreach ($odds as $num => $result) {
    if ($result->isSucceeded()) {
      echo "$num Success: ";
      \var_dump($result->getResult());
    } else {
      echo "$num Failed: ";
      \var_dump($result->getException()->getMessage());
    }
  }
}
