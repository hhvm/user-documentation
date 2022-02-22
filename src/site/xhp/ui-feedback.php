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
use type Facebook\XHP\HTML\{div, i, script};
use type HHVM\UserDocumentation\{
  github_issue_link,
};

final xhp class feedback extends x\element {

  <<__Override>>
  protected async function renderAsync(): Awaitable<x\node> {
    $thumbs_up =
      <i class="fa fa-solid fa-thumbs-up fa-lg"></i>;

    $thumbs_down =
      <i class="fa fa-solid fa-thumbs-down fa-lg"></i>;

    $feedback =
      <div id="form-basic">Was This Page Useful?
        {$thumbs_up}
        {$thumbs_down}
      </div>;

    $good_feedback =
      <div id="form-yes">Thank You!</div>;

    $bad_feedback =
      <div id="form-no">Thank You. Please <github_issue_link issueTitle={$this->getGithubIssueTitle()} issueBody={$this->getGithubIssueBody()}>File an Issue</github_issue_link> to help future readers!</div>;

    $container = (
      <div class="feedbackForm">
        {$feedback}
        {$good_feedback}
        {$bad_feedback}
      </div>
    );

    $container->appendChild(varray[
      $this->toggleGoodFeedbackScript($thumbs_up, $container),
      $this->toggleBadFeedbackScript($thumbs_down, $container),
    ]);

    return $container;
  }

  private function toggleGoodFeedbackScript(i $button, div $container): script {
    $button_id = \json_encode($button->getID());
    $container_id = \json_encode($container->getID());
    return (
      <script language="javascript">
        var toggleButton = document.getElementById({$button_id});
        toggleButton.addEventListener(
        'click',
        function() {"{"}
        var toggleContainer = document.getElementById({$container_id});
        toggleContainer.classList.toggle('feedbackPromptOff');
        toggleContainer.classList.toggle('goodFeedbackOn');
        {"}"}
        );
      </script>
    );
  }

  private function toggleBadFeedbackScript(i $button, div $container): script {
    $button_id = \json_encode($button->getID());
    $container_id = \json_encode($container->getID());
    return (
      <script language="javascript">
        var toggleButton = document.getElementById({$button_id});
        toggleButton.addEventListener(
        'click',
        function() {"{"}
        var toggleContainer = document.getElementById({$container_id});
        toggleContainer.classList.toggle('feedbackPromptOff');
        toggleContainer.classList.toggle('badFeedbackOn');
        {"}"}
        );
      </script>
    );
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
