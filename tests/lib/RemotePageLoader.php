<?hh // strict

namespace HHVM\UserDocumentation\Tests;

use \Psr\Http\Message\ResponseInterface;
use \HHVM\UserDocumentation\ArgAssert;
use \Response;

final class RemotePageLoader extends PageLoader {
  protected function __construct() {}

  protected async function getPageImpl(
    string $path,
  ): Awaitable<ResponseInterface> {
    $host = ArgAssert::isNotNull(self::getHost());
    $url = 'http://'.$host.$path;

    $ch = curl_init($url);
    $body = await \HH\Asio\curl_exec($ch);
    $status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);

    invariant(
      $status !== 0,
      curl_error($ch),
    );

    return Response::newWithStringBody($body)
      ->withStatus($status);
  }
}
