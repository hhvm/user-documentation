// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\AsynchronousOperations\Extensions\AsyncMcrouter;

function get_mcrouter_object(): \MCRouter {
  $servers = Vector {\getenv('HHVM_TEST_MCROUTER')};
  $mc = \MCRouter::createSimple($servers);
  return $mc;
}

async function add_user_name(
  \MCRouter $mcr,
  int $id,
  string $value,
): Awaitable<void> {
  $key = 'name:'.$id;
  await $mcr->set($key, $value);
}

async function get_user_name(\MCRouter $mcr, int $user_id): Awaitable<string> {
  $key = 'name:'.$user_id;
  try {
    $res = await \HH\Asio\wrap($mcr->get($key));
    if ($res->isSucceeded()) {
      return $res->getResult();
    }
    return "";
  } catch (\MCRouterException $ex) {
    echo $ex->getKey().\PHP_EOL.$ex->getOp();
    return "";
  }
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  \init_docs_autoloader();

  $mcr = get_mcrouter_object();
  await add_user_name($mcr, 1, 'Joel');
  $name = await get_user_name($mcr, 1);
  \var_dump($name); // Should print "Joel"
}
