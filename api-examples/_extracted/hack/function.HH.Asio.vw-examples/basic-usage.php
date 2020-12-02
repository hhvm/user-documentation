<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\FunctionHHAsioVw\BasicUsage;

async function one(): Awaitable<int> {
  return 1;
}

<<__EntryPoint>>
async function basic_usage_main(): Awaitable<void> {
  \init_docs_autoloader();

  $mcr = \MCRouter::createSimple(ImmVector {});

  $handles = \HH\Asio\vw(Vector {
    // This will throw an exception, since there's no servers to speak to
    $mcr->get("no-such-key"),

    // While this will obviously succeed
    one(),
  });

  $results = await $handles;
  foreach ($results as $result) {
    if ($result->isSucceeded()) {
      echo "Success: ";
      \var_dump($result->getResult());
    } else {
      echo "Failed: ";
      \var_dump($result->getException()->getMessage());
    }
  }
}
