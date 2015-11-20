<?hh // strict

use HHVM\UserDocumentation\BuildPaths;
use Psr\Http\Message\ServerRequestInterface;

final class :github-issue-link extends :x:element {
  attribute
    string issueTitle @required,
    string issueBody @required;

  children (pcdata);

  protected function render(): XHPRoot {
    $body = $this->:issueBody."\n\n".$this->getMetadataForBody();

    $new_issue_prefill_url = sprintf(
      '%s?title=%s&body=%s',
      'https://github.com/hhvm/user-documentation/issues/new',
      urlencode($this->:issueTitle),
      urlencode($body),
    );
    return (
      <a href={$new_issue_prefill_url} target="_blank">
        {$this->getChildren()}
      </a>
    );
  }
  
  private function getMetadataForBody(): string {
    $build_id = trim(file_get_contents(BuildPaths::BUILD_ID));
    $request_time = (new DateTime())
      ->setTimezone(new DateTimeZone('Etc/UTC'))
      ->format(DateTime::RFC2822);
    $request_path = $this->getRequest()->getUri()->getPath();

    return <<<EOF
--------------------------------

Please don't change anything below this point.

--------------------------------

 - Build ID: $build_id
 - Page requested: $request_path
 - Page requested at: $request_time
EOF;
  }

  private function getRequest(): ServerRequestInterface {
    $x = $this->getContext('ServerRequestInterface');
    invariant(
      $x instanceof ServerRequestInterface,
      '%s is not a ServerRequestInterface',
      gettype($x).' ('.get_class($x).')',
    );
    return $x;
  }
}
