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
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $response = await \HH\Asio\curl_exec($ch);
    $status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);

    invariant(
      $status !== 0,
      curl_error($ch),
    );

    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header_blob = substr($response, 0, $header_size);
    $header_lines = explode("\r\n", trim($header_blob));
    array_shift($header_lines); // status code and http ver

    if ($header_size === strlen($response)) {
      $body = '';
    } else {
      $body = substr($response, $header_size);
    }

    $response = Response::newWithStringBody($body)->withStatus($status);

    foreach ($header_lines as $header_line) {
      list($name, $value) = explode(": ", $header_line);
      $response = $response->withAddedHeader($name, $value);
    }

    return $response;
  }
}
