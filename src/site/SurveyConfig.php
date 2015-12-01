<?hh // strict

namespace HHVM\UserDocumentation;
use Psr\Http\Message\ServerRequestInterface;

final class SurveyConfig {
  const SurveyMode MODE = SurveyMode::ACTIVE;

  const string STATE_COOKIE = 'user_survey_state';
  const string BUCKET_COOKIE = 'user_survey_bucket';
  const string COUNTER_COOKIE = 'user_survey_visit_counter';

  const string SURVEY_URL =
    'https://www.facebook.com/survey?_rdr=p&oid=675520525918833';

  // Users are put into buckets 1..100
  const int ACTIVE_BUCKET_MIN = 1;
  const int ACTIVE_BUCKET_MAX = 30;

  const int MIN_VISITS_BEFORE_SHOW = 3;
  const int MIN_SHOWS = 5;
  const int MAX_SHOWS = 20;

  public function __construct(
    private ServerRequestInterface $request,
  ) {
  }

  public function shouldShowSurvey(): bool {
    switch (self::MODE) {
      case SurveyMode::ALWAYS:
        return true;
      case SurveyMode::DISABLED:
        return false;
      case SurveyMode::ACTIVE:
        break;
    }

    if (!$this->isInActiveBucket()) {
      return false;
    }

    if ($this->getUserState() !== SurveyUserState::ACTIVE) {
      return false;
    }

    $counter = $this->getVisitCounter();
    return (
      $counter >= self::MIN_VISITS_BEFORE_SHOW
      && $counter <= self::MIN_VISITS_BEFORE_SHOW + self::MAX_SHOWS
    );
  }

  public function shouldShowNoThanks(): bool {
    if (self::MODE === SurveyMode::ALWAYS) {
      return true;
    }

    $show_from = self::MIN_VISITS_BEFORE_SHOW + self::MIN_SHOWS;

    $counter = $this->getVisitCounter();
    return $counter >= $show_from;
  }

  public static function redirect(): noreturn {
    self::setCookie(self::STATE_COOKIE, SurveyUserState::TAKEN);
    throw new \RedirectException(self::SURVEY_URL);
  }

  public static function saveNoThanks(): void {
    self::setCookie(self::STATE_COOKIE, SurveyUserState::NO_THANKS);
  }

  private function getUserState(): SurveyUserState {
    $cookies = $this->request->getCookieParams();
    $state = SurveyUserState::coerce(
      idx($cookies, self::STATE_COOKIE)
    );
    if ($state === null) {
      $state = SurveyUserState::ACTIVE;
    } 
    return $state;
  }

  private function getUserBucket(): int {
    $cookies = $this->request->getCookieParams();
    $bucket = idx($cookies, self::BUCKET_COOKIE);
    if (ctype_digit($bucket) && (int) $bucket > 0 && (int) $bucket <= 100) {
      $bucket = (int) $bucket;
    } else {
      $bucket = random_int(1, 100);
      self::setCookie(self::BUCKET_COOKIE, $bucket);
    }
    return $bucket;
  }

  private function isInActiveBucket(): bool {
    $bucket = $this->getUserBucket();
    return $bucket >= self::ACTIVE_BUCKET_MIN
      && $bucket <= self::ACTIVE_BUCKET_MAX;
  }

  // Memoize to only increment once pre request
  <<__Memoize>>
  private function getVisitCounter(): int {
    $cookies = $this->request->getCookieParams();
    $counter = idx($cookies, self::COUNTER_COOKIE);
    if (ctype_digit($counter)) {
      $counter = (int) $counter;
    } else {
      $counter = 0;
    }
    ++$counter;
    self::setCookie(self::COUNTER_COOKIE, $counter);
    return $counter;
  }

  private static function setCookie(string $name, mixed $value): void {
    $expire = time() + (60 * 60 * 24 * 365);

    setcookie($name, $value, $expire, '/');
  }
}
