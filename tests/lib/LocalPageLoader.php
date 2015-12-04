<?hh

namespace HHVM\UserDocumentation\Tests;

use \Zend\Diactoros\ServerRequest;
use \Psr\Http\Message\ResponseInterface;

final class LocalPageLoader extends PageLoader {
  protected function __construct() {}

  protected async function getPageImpl(
    string $url,
  ): Awaitable<ResponseInterface> {
    $request = new ServerRequest(
      /* server = */ [],
      /* file = */ [],
      $url,
      'GET',
      /* body = */ '/dev/null',
      /* headers = */ [],
    );

    return await \HHVMDocumentationSite::getResponseForRequest($request);
  }
}
