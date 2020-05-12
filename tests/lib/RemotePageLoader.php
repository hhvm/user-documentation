<?hh // strict

namespace HHVM\UserDocumentation\Tests;

use namespace Nuxed\Contract\Http\Message;
use namespace Nuxed\Http;
use namespace Facebook\TypeAssert;
use namespace HH\Lib\Str;

final class RemotePageLoader extends PageLoader {
  protected function __construct() {}

  <<__Override>>
  protected async function getPageImplAsync(
    string $url,
  ): Awaitable<(Message\IResponse, string)> {
    $uri = Http\Message\uri($url);
    $test_host = TypeAssert\not_null(self::getHost());
    if ($uri->getScheme() is null) {
      switch ($test_host) {
        case 'docs.hhvm.com':
        case 'staging.docs.hhvm.com':
          $uri = $uri->withScheme('https');
          break;
        default:
          $uri = $uri->withScheme('http');
      }
    }

    $ch = \curl_init($uri->toString());
    \curl_setopt($ch, \CURLOPT_HEADER, 1);
    \curl_setopt($ch, \CURLOPT_RETURNTRANSFER, 1);

    $host = $uri->getHost();
    if ($host is nonnull) {
      \curl_setopt($ch, \CURLOPT_HTTPHEADER, varray['Host: '.$host]);
    }

    $response = await \HH\Asio\curl_exec($ch);
    $status = (int)\curl_getinfo($ch, \CURLINFO_HTTP_CODE);

    invariant($status !== 0, '%s', \curl_error($ch));

    $header_size = \curl_getinfo($ch, \CURLINFO_HEADER_SIZE);
    $header_blob = \substr($response, 0, $header_size);
    $header_lines = \explode("\r\n", \trim($header_blob));
    \array_shift(inout $header_lines); // status code and http ver

    if ($header_size === \strlen($response)) {
      $body = '';
    } else {
      $body = \substr($response, $header_size);
    }

    $response = Http\Message\response($status);
    foreach ($header_lines as $header_line) {
      list($name, $value) = Str\split($header_line, ": ");
      $response = $response->withAddedHeader($name, vec[$value]);
    }

    return tuple($response, $body);
  }
}
