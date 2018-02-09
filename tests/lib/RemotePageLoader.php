<?hh // strict

namespace HHVM\UserDocumentation\Tests;

use type \Psr\Http\Message\ResponseInterface;
use type \Response;
use namespace Facebook\TypeAssert;

final class RemotePageLoader extends PageLoader {
  protected function __construct() {}

  <<__Override>>
  protected async function getPageImpl(
    string $url,
  ): Awaitable<ResponseInterface> {
    $host_header = \parse_url($url, \PHP_URL_HOST);
    $scheme = \parse_url($url, \PHP_URL_SCHEME);
    $path = \parse_url($url, \PHP_URL_PATH);
    $query = \parse_url($url, \PHP_URL_QUERY);

    $test_host = TypeAssert\not_null(self::getHost());
    if ($scheme === null) {
      switch ($test_host) {
        case 'docs.hhvm.com':
        case 'staging.docs.hhvm.com':
          $scheme = 'https';
          break;
        default:
          $scheme = 'http';
      }
    }
    $url = $scheme.'://'.$test_host.$path;
    if ($query !== null) {
      $url .= '?'.$query;
    }

    $ch = \curl_init($url);
    \curl_setopt($ch, \CURLOPT_HEADER, 1);
    \curl_setopt($ch, \CURLOPT_RETURNTRANSFER, 1);

    if ($host_header) {
      \curl_setopt($ch, \CURLOPT_HTTPHEADER, ['Host: '.$host_header]);
    }

    $response = await \HH\Asio\curl_exec($ch);
    $status = (int) \curl_getinfo($ch, \CURLINFO_HTTP_CODE);

    invariant(
      $status !== 0,
      '%s',
      \curl_error($ch),
    );

    $header_size = \curl_getinfo($ch, \CURLINFO_HEADER_SIZE);
    $header_blob = \substr($response, 0, $header_size);
    $header_lines = \explode("\r\n", \trim($header_blob));
    \array_shift(&$header_lines); // status code and http ver

    if ($header_size === \strlen($response)) {
      $body = '';
    } else {
      $body = \substr($response, $header_size);
    }

    $response = Response::newWithStringBody($body)->withStatus($status);

    foreach ($header_lines as $header_line) {
      list($name, $value) = \explode(": ", $header_line);
      $response = $response->withAddedHeader($name, $value);
    }

    return $response;
  }
}
