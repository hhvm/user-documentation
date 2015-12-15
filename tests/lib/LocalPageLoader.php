<?hh

namespace HHVM\UserDocumentation\Tests;

use \Zend\Diactoros\ServerRequest;
use \Psr\Http\Message\ResponseInterface;

final class LocalPageLoader extends PageLoader {
  protected function __construct() {}

  protected async function getPageImpl(
    string $url,
  ): Awaitable<ResponseInterface> {
    $path = parse_url($url, PHP_URL_PATH);
    $query = parse_url($url, PHP_URL_QUERY);

    $query_params = [];
    parse_str($query, $query_params);

    $request = (new ServerRequest(
      /* server = */ [],
      /* file = */ [],
      $path,
      'GET',
      /* body = */ '/dev/null',
      /* headers = */ [],
    ))->withQueryParams($query_params);

    return await \HHVMDocumentationSite::getResponseForRequest($request);
  }
}
