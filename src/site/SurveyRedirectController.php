<?hh // strict

use Psr\Http\Message\ResponseInterface;

final class SurveyRedirectController extends WebController {
  public function getResponse(): Awaitable<ResponseInterface> {
    HHVM\UserDocumentation\SurveyConfig::redirect();
  }
}
