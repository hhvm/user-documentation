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
          You can also
          <a:post href="/__survey/nothanks">hide this message</a:post>.
        </x:frag>
      );
    }

    return (
      <div class="userSurvey">
        We'd appreciate your feedback; if you can spare a few seconds, we have a
        <a:post href="/__survey/go" target="_blank">5-question survey</a:post>.
        {$no_thanks}
      </div>
    );
  }
}
