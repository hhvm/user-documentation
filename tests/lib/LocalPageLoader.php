<?hh // partial

namespace HHVM\UserDocumentation\Tests;

use namespace AzJezz\HttpNormalizer;
use namespace Nuxed\Http;
use namespace Nuxed\Contract\Http\Message;
use namespace HH\Lib\Math;

final class LocalPageLoader extends PageLoader {
  protected function __construct() {}

  <<__Override>>
  protected async function getPageImplAsync(
    string $url,
  ): Awaitable<(Message\IResponse, string)> {
    $query_params = dict[];
    $url = Http\Message\uri($url);
    $query_part = $url->getQuery();
    if ($query_part !== null) {
      $query_params = HttpNormalizer\parse($query_part);
    }

    $request = new Http\Message\ServerRequest(Message\RequestMethod::Get, $url)
      |> $$->withQueryParams(dict($query_params));

    $response = await (new \HHVMDocumentationSite())->handle($request);
    $body = $response->getBody();
    await $body->seekAsync(0);
    $content = await $body->readAsync(Math\INT64_MAX);

    return tuple($response, $content);
  }
}
