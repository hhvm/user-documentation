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

namespace HHVM\UserDocumentation\ui;

use namespace Facebook\XHP\Core as x;
use type Facebook\XHP\HTML\{a, div, i, script};
use type HHVM\UserDocumentation\ github_issue_link;

final xhp class feedback extends x\element {

  <<__Override>>
  protected async function renderAsync(): Awaitable<x\node> {
    $feedback_message =
      <div id="feedback-prompt-message">Was This Page Useful?
        <a id="like-feedback" href="#"><i class="fa fa-solid fa-thumbs-up fa-lg"></i></a>
        <a id="dislike-feedback" href="#"><i class="fa fa-solid fa-thumbs-down fa-lg"></i></a>
      </div>;

    $good_feedback_message =
      <div id="like-message">Thank You!</div>;

    $bad_feedback_message =
      <div id="dislike-message">Thank You! If you'd like to share more feedback, please <github_issue_link issueTitle={$this->getGithubIssueTitle()} issueBody={$this->getGithubIssueBody()}>file an issue</github_issue_link>.</div>;

    $container = (
      <div id="feedback-container" class="pageFeedback">
        {$feedback_message}
        {$good_feedback_message}
        {$bad_feedback_message}
      </div>
    );

    $container->appendChild(varray[<script type="application/javascript" src="/js/feedback.js"></script>]);

    return $container;
  }

  protected function getGithubIssueTitle(): ?string {
    return null;
  }

  protected function getGithubIssueBody(): string {
    return <<<EOF
Please complete the information below:

# Where is the problem?

- e.g. "The section describing how widgets work"

# What is the problem?

- e.g. "It doesn't explain that widgets are singletons"
EOF;
  }

}
