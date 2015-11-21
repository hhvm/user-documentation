<?hh // strict

use Psr\Http\Message\ServerRequestInterface;

final class SurveyNoThanksController extends WebController {
  public function __construct(
    ImmMap<string,string> $parameters,
    protected ServerRequestInterface $request,
  ) {
    parent::__construct($parameters, $request);
  }

  public async function respond(): Awaitable<void> {
    HHVM\UserDocumentation\SurveyConfig::saveNoThanks();
    throw new RedirectException(
      $this->request->getHeaders()['referer'][0],
    );
  }
}
