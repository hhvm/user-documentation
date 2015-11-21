<?hh // strict

final class SurveyRedirectController extends WebController {
  public async function respond(): Awaitable<void> {
    HHVM\UserDocumentation\SurveyConfig::redirect();
  }
}
