<?hh // strict

use HHVM\UserDocumentation\StaticResourceMap;
use Psr\Http\Message\ResponseInterface;

final class StaticResourcesController extends WebController {
  public async function getResponse(): Awaitable<ResponseInterface> {
    $checksum = $this->getRequiredStringParam('checksum');
    $file = $this->getRequiredStringParam('file');

    $entry = self::invariantTo404(
      () ==> StaticResourceMap::getEntryForFile($file)
    );

    if ($checksum !== $entry['checksum'] && $checksum !== 'local-changes') {
      throw new HTTPNotFoundException();
    }

    $response = Response::newWithStringBody(
      file_get_contents($entry['localPath'])
    )->withAddedHeader('Content-Type', $entry['mimeType']);

    if ($checksum === 'local-changes') {
      $response = $response->withAddedHeader(
        'Cache-Control',
        'max-age=0, no-cache, no-store',
      );
    } else {
      $response = $response->withAddedHeader(
        'Cache-Control',
        'max-age=31556926', // 1 year
      )->withAddedHeader(
        'ETag',
        '"'.$checksum.'"',
      );
    }
    return $response;
  }
}
