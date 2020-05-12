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
use namespace Nuxed\Contract\Http\Message;
use namespace Nuxed\Http\Message\{Body, Response};

use function Nuxed\Http\Message\response;

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
  public async function getResponseAsync(): Awaitable<Message\IResponse> {
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

    $response = response(
      Message\StatusCode::Ok,
      dict['Content-Type' => vec[$entry['mimeType']]],
      Body\file($entry['localPath']),
    );

    if (
      $checksum === 'local-changes' && $this->getParameters()['MTime'] === null
    ) {
      $response = Response\with_max_age($response, 0)
        |> Response\with_cache_control_directive($$, 'no-cache')
        |> Response\with_cache_control_directive($$, 'no-store');
    } else {
      $response = Response\with_max_age($response, 31556926) // 1 year
        |> Response\with_etag($$, $checksum);
    }

    return $response;
  }
}
