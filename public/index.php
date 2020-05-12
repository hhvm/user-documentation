<?hh // strict

require_once(__DIR__.'/../vendor/autoload.hack');

use namespace Nuxed\Http;
use namespace HH\Lib\Str;

<<__EntryPoint>>
async function site_main_async(): Awaitable<void> {
  \Facebook\AutoloadMap\initialize();

  $app = new HHVMDocumentationSite();

  $request = await Http\Message\ServerRequest::capture();

  $response = await $app->handle($request);

  await Http\Emitter\emit($response);
}
