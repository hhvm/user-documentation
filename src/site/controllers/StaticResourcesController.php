<?hh // strict

use Facebook\HackRouter\IntRequestParameter;
use HHVM\UserDocumentation\StaticResourceMap;
use Psr\Http\Message\ResponseInterface;

final class StaticResourcesController
extends WebController
implements RoutableGetController {
  use StaticResourcesControllerParametersTrait;
  public static function getUriPattern(): UriPattern {
    return (new UriPattern())
      ->literal('/s/')
      ->string('Checksum')
      ->literal('/')
      ->stringWithSlashes('File');
  }

  <<__Override>>
  protected static function getExtraParametersSpec(
  ): self::TParameterDefinitions {
    return shape(
      'required' => ImmVector {},
      'optional' => ImmVector { new IntRequestParameter('MTime') },
    );
  }

  public async function getResponse(): Awaitable<ResponseInterface> {
    $params = $this->getParameters();
    $checksum = $params['Checksum'];
    $file = '/'.$params['File'];

    $entry = self::invariantTo404(
      () ==> StaticResourceMap::getEntryForFile($file)
    );

    if (
      $checksum !== $entry['checksum']
      && $checksum !== 'local-changes'
      && $checksum !== 'evergreen'
    ) {
      throw new HTTPNotFoundException();
    }

    $response = Response::newWithStringBody(
      file_get_contents($entry['localPath'])
    )->withAddedHeader('Content-Type', $entry['mimeType']);

    if (
      $checksum === 'local-changes'
      && $this->getParameters()['MTime'] === null
    ) {
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
