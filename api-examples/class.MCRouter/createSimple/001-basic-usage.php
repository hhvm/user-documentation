<?hh

namespace Hack\UserDocumentation\API\Examples\MCRouter\MCrouter\CSimple;

function simple_mcrouter(): void {
  $servers = Vector {\getenv('HHVM_TEST_MCROUTER')};
  $mc = \MCRouter::createSimple($servers);
  \var_dump($mc is \MCRouter);
}

<<__EntryPoint>>
function basic_usage_main(): void {
  simple_mcrouter();
}
