<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassMCRouterMethodGetResultName\BasicUsage;

function get_simple_mcrouter(): \MCRouter {
  $servers = Vector {\getenv('HHVM_TEST_MCROUTER')};
  $mc = \MCRouter::createSimple($servers);
  return $mc;
}

function get_res_name(int $res_num): string {
  return \MCRouter::getResultName($res_num);
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  \init_docs_autoloader();

  $mc = get_simple_mcrouter();

  // You can pass raw integers
  \var_dump(get_res_name(3));
  \var_dump(get_res_name(9));
  \var_dump(get_res_name(-1));
  \var_dump(get_res_name(0));
  \var_dump(get_res_name(100));

  // You can pass MCRouter constants
  \var_dump(get_res_name(\MCRouter::mc_res_timeout));
  \var_dump(get_res_name(\MCRouter::mc_res_bad_flags));
  \var_dump(get_res_name(\MCRouter::mc_res_local_error));

  // You can pass something from an exception too
  try {
    $val = await $mc->get('KEYDOESNOTEXISTIHOPEREALLY');
  } catch (\MCRouterException $ex) {
    \var_dump($ex->getCode());
    \var_dump(get_res_name($ex->getCode()));
  }
}
