<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\FunctionHHAsioMmw\BasicUsage;

<<__EntryPoint>>
async function basic_usage_main(): Awaitable<void> {
  \init_docs_autoloader();

  // Map a map of numbers to their integer half
  // throwing if they can't be divided evenly
  $halves = await \HH\Asio\mmw(
    Map {
      'one' => 1,
      'two' => 2,
      'three' => 3,
      'four' => 4,
    },

    async ($val) ==> {
      if ($val % 2) {
        throw new \Exception("$val is an odd number");
      } else {
        return $val / 2;
      }
    },
  );

  foreach ($halves as $num => $result) {
    if ($result->isSucceeded()) {
      echo "$num / two Success: ";
      \var_dump($result->getResult());
    } else {
      echo "$num / two Failed: ";
      \var_dump($result->getException()->getMessage());
    }
  }
}
