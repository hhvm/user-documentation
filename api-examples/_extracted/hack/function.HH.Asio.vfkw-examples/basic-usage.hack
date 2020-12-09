<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\FunctionHHAsioVfkw\BasicUsage;

<<__EntryPoint>>
async function basic_usage_main(): Awaitable<void> {
  \init_docs_autoloader();

  // Return all non-negative odd numbers
  // Positive evens and odds at every third index filtered out,
  // Negatives and zero cause exception
  $odds = await \HH\Asio\vfkw(
    Vector {-1, 0, 1, 2, 3, 4, 5},

    async ($idx, $val) ==> {
      if ($val <= 0) {
        throw new \Exception("$val is non-positive");
      } else {
        return ($idx % 3) && ($val % 2);
      }
    },
  );

  foreach ($odds as $result) {
    if ($result->isSucceeded()) {
      echo "Success: ";
      \var_dump($result->getResult());
    } else {
      echo "Failed: ";
      \var_dump($result->getException()->getMessage());
    }
  }
}
