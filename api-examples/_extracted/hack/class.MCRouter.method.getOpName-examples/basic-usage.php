<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassMCRouterMethodGetOpName\BasicUsage;

function get_simple_mcrouter(): \MCRouter {
  $servers = Vector {\getenv('HHVM_TEST_MCROUTER')};
  $mc = \MCRouter::createSimple($servers);
  return $mc;
}

function get_op_name(int $op_num): string {
  return \MCRouter::getOpName($op_num);
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  \init_docs_autoloader();

  $mc = get_simple_mcrouter();

  // You can pass raw integers
  \var_dump(get_op_name(3));
  \var_dump(get_op_name(9));
  \var_dump(get_op_name(-1));
  \var_dump(get_op_name(0));
  \var_dump(get_op_name(100));

  // You can pass MCRouter constants
  \var_dump(get_op_name(\MCRouter::mc_op_servererr));
  \var_dump(get_op_name(\MCRouter::mc_op_exec));
  \var_dump(get_op_name(\MCRouter::mc_op_unknown));

  // You can pass something from an exception too
  try {
    $val = await $mc->get('KEYDOESNOTEXISTIHOPEREALLY');
  } catch (\MCRouterException $ex) {
    \var_dump($ex->getOp());
    \var_dump(get_op_name($ex->getOp()));
  }
}
