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

namespace HHVM\UserDocumentation;

use namespace Facebook\XHP\{ChildValidation as XHPChild, Core as x};
use type Facebook\XHP\HTML\a;
use type HHVM\UserDocumentation\LocalConfig;

final xhp class github_issue_link extends x\element {
  use XHPChild\Validation;
  attribute
    string issueTitle,
    string issueBody @required,
    classname<\WebController> controller;

  protected static function getChildrenDeclaration(): XHPChild\Constraint {
    return XHPChild\sequence(
      XHPChild\optional(XHPChild\of_type<ui\glyph>()),
      XHPChild\pcdata(),
    );
  }


  use XHPGetRequest;

  <<__Override>>
  protected async function renderAsync(): Awaitable<x\node> {
    $body = $this->:issueBody."\n\n".$this->getMetadataForBody();

    $new_issue_prefill_url = \sprintf(
      '%s?title=%s&body=%s',
      'https://github.com/hhvm/user-documentation/issues/new',
      \urlencode($this->:issueTitle ?? ''),
      \urlencode($body),
    );

    return (
      <a href={$new_issue_prefill_url}>
        {$this->getChildren()}
      </a>
    );
  }

  private function getMetadataForBody(): string {
    $build_id = LocalConfig::getBuildID();
    $request_time = (new \DateTime())
      ->setTimezone(new \DateTimeZone('Etc/UTC'))
      ->format(\DateTime::RFC2822);
    $request_path = $this->getRequest()->getUri()->getPath();

    $rows = Vector {
      'Build ID: '.$build_id,
      'Page requested: '.$request_path,
      'Page requested at: '.$request_time,
    };

    $controller = $this->:controller;
    if ($controller !== null) {
      $rows[] = 'Controller: '.$controller;
    }

    $rows = \implode("\n", $rows->map($x ==> ' - '.$x));

    return <<<EOF
--------------------------------

Please don't change anything below this point.

--------------------------------

$rows
EOF;
  }
}
