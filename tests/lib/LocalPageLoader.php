<?hh

namespace HHVM\UserDocumentation\Tests;

use \Zend\Diactoros\ServerRequest;
use \Psr\Http\Message\ResponseInterface;

final class LocalPageLoader extends PageLoader {
  protected function __construct() {}

  <<__Override>>
  protected async function getPageImpl(
    string $url,
  ): Awaitable<ResponseInterface> {
    $query_params = [];
    $query_part = \parse_url($url, \PHP_URL_QUERY);
    if ($query_part !== null) {
      \parse_str($query_part, &$query_params);
    }

    /* HH_IGNORE_ERROR[2049] no HHI for diactoros */
    $request = (new ServerRequest(
      /* server = */ [],
      /* file = */ [],
      $url,
      'GET',
      /* body = */ '/dev/null',
      /* headers = */ [],
    ))->withQueryParams($query_params);

    return await \HHVMDocumentationSite::getResponseForRequest($request);
  }
}
