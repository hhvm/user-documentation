<?hh // strict
/*
 *  Copyright (c) 2004-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the BSD-style license found in the
 *  LICENSE file in the root directory of this source tree. An additional grant
 *  of patent rights can be found in the PATENTS file in the same directory.
 *
 */

use type Facebook\HackRouter\IntRequestParameter;
use type HHVM\UserDocumentation\StaticResourceMap;
use type Facebook\Experimental\Http\Message\ResponseInterface;

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
      'optional' => ImmVector {new IntRequestParameter('MTime')},
    );
  }

  <<__Override>>
  public async function getResponseAsync(
    ResponseInterface $response,
  ): Awaitable<ResponseInterface> {
    $params = $this->getParameters();
    $checksum = $params['Checksum'];
    $file = '/'.$params['File'];

    $entry = self::invariantTo404(
      () ==> StaticResourceMap::getEntryForFile($file),
    );

    if (
      $checksum !== $entry['checksum'] &&
      $checksum !== 'local-changes' &&
      $checksum !== 'evergreen'
    ) {
      throw new HTTPNotFoundException();
    }

    await $response->getBody()
      ->writeAllAsync(\file_get_contents($entry['localPath']));
    $response = $response->withHeader('Content-Type', vec[$entry['mimeType']]);

    if (
      $checksum === 'local-changes' && $this->getParameters()['MTime'] === null
    ) {
      $response = $response->withAddedHeader(
        'Cache-Control',
        vec['max-age=0, no-cache, no-store'],
      );
    } else {
      $response = $response->withAddedHeader(
        'Cache-Control',
        vec['max-age=31556926'], // 1 year
      )
        ->withAddedHeader('ETag', vec['"'.$checksum.'"']);
    }
    return $response;
  }
}
