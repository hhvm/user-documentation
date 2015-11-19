<?hh // strict

use HHVM\UserDocumentation\StaticResourceMap;

final class StaticResourcesController extends WebController {
  public async function respond(): Awaitable<void> {
    $checksum = $this->getRequiredStringParam('checksum');
    $file = $this->getRequiredStringParam('file');

    // Throws exception if not in the map
    $entry = StaticResourceMap::getEntryForFile(
      $file,
    );

    if ($checksum !== $entry['checksum'] && $checksum !== 'local-changes') {
      throw new HTTPNotFoundException();
    }

    header('Content-Type: '.$entry['mimeType']);
    if ($checksum === 'local-changes') { 
      header('Cache-Control: max-age=0, no-cache, no-store');
    } else {
      header('Cache-Control: max-age=31556926'); // 1 year
      header(sprintf('ETag: "%s"', $checksum));
    }
    echo file_get_contents($entry['localPath']);
  }
}
