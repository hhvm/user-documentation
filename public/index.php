<?hh // strict

require_once(__DIR__.'/../vendor/hh_autoload.php');

<<__EntryPoint>>
async function site_main_async(): Awaitable<noreturn> {
  $request = Usox\HackTTP\ServerRequest::createFromGlobals();
  await HHVMDocumentationSite::respondToAsync($request);
  exit(0);
}
