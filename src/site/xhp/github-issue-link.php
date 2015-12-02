<?hh // strict

use HHVM\UserDocumentation\BuildPaths;
use HHVM\UserDocumentation\UIGlyphIcon;

final class :github-issue-link extends :x:element {
  attribute
    string issueTitle,
    string issueBody @required;

  children (pcdata);

  use XHPGetRequest;

  protected function render(): XHPRoot {
    $body = $this->:issueBody."\n\n".$this->getMetadataForBody();

    $new_issue_prefill_url = sprintf(
      '%s?title=%s&body=%s',
      'https://github.com/hhvm/user-documentation/issues/new',
      urlencode($this->:issueTitle),
      urlencode($body),
    );

    return (
      <ui:button
        className="gitHubIssueButton"
        href={$new_issue_prefill_url}
        glyph={UIGlyphIcon::BUG}
        size="small"
        target="_blank"
        use="confirm">
        {$this->getChildren()}
      </ui:button>
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
}
