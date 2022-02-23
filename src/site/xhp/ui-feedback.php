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
use type HHVM\UserDocumentation\{
  github_issue_link,
};

final xhp class feedback extends x\element {

  <<__Override>>
  protected async function renderAsync(): Awaitable<x\node> {
    $thumbs_up =
      <a id="like-feedback" href="#"><i class="fa fa-solid fa-thumbs-up fa-lg"></i></a>;

    $thumbs_down =
      <a id="dislike-feedback" href="#"><i class="fa fa-solid fa-thumbs-down fa-lg"></i></a>;

    $feedback_message =
      <div id="feedback-prompt-message">Was This Page Useful?
        {$thumbs_up}
        {$thumbs_down}
      </div>;

    $good_feedback_message =
      <div id="like-message">Thank You!</div>;

    $bad_feedback_message =
      <div id="dislike-message">Thank You. If you have feedback, you can <github_issue_link issueTitle={$this->getGithubIssueTitle()} issueBody={$this->getGithubIssueBody()}>File an Issue</github_issue_link> to help future readers!</div>;

    $container = (
      <div id="feedback-container" class="pageFeedback">
        {$feedback_message}
        {$good_feedback_message}
        {$bad_feedback_message}
      </div>
    );

    $container->appendChild(varray[
      $this->toggleFeedbackScript(),
    ]);

    return $container;
  }

  private function toggleFeedbackScript(): script {
    return (
      <script language="javascript">
        var likeIcon = document.getElementById("like-feedback");
        var dislikeIcon = document.getElementById("dislike-feedback");
        likeIcon.addEventListener(
        'click',
        function(e) {"{"}
        e.preventDefault();
        var feedbackContainer = document.getElementById("feedback-container");
        feedbackContainer.classList.toggle('feedbackPromptOff');
        feedbackContainer.classList.toggle('likeFeedbackOn');
        ga('send', 'event', 'Feedback', 'Useful', 'Guides Page', 1);
        {"}"}
        );
        dislikeIcon.addEventListener(
        'click',
        function(e) {"{"}
        e.preventDefault();
        var feedbackContainer = document.getElementById("feedback-container");
        feedbackContainer.classList.toggle('feedbackPromptOff');
        feedbackContainer.classList.toggle('dislikeFeedbackOn');
        ga('send', 'event', 'Feedback', 'Not Useful', 'Guides Page', 0);
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
