<?hh // strict

use HHVM\UserDocumentation\SurveyConfig;

final class :user-survey extends :x:element {
  use XHPGetRequest;

  protected function render(): XHPRoot {
    $config = new SurveyConfig($this->getRequest());
    if (!$config->shouldShowSurvey()) {
      return <x:frag />;
    }

    $no_thanks = null;
    if ($config->shouldShowNoThanks()) {
      $no_thanks = (
        <x:frag>
          <a:post class="noButton" href="/__survey/nothanks">No Thanks</a:post>
        </x:frag>
      );
    }

    return (
      <div class="widthWrapper surveyWrapper">
        <div class="userSurvey mainWrapper">
          <div class="surveyTitle">Feedback</div>
          <div class="surveyMessage">
            <p>
              We'd appreciate your feedback on this documentation - if you can spare a few seconds, we have a 5-question survey.
            </p>
            <div class="surveyButtons">
              <a:post class="yesButton" href="/__survey/go" target="_blank">
                Take Survey
              </a:post>
              {$no_thanks}
            </div>
          </div>
        </div>
      </div>
    );
  }
}
