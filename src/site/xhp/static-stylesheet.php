<?hh // strict

use HHVM\UserDocumentation\StaticResourceMap;

final class :static:stylesheet extends :static:base {
  use XHPHelpers;

  attribute :link;

  protected function getAllowedMimeTypes(): Set<string> {
    return Set { 'text/css' };
  }

  protected function render(): XHPRoot {
    return
      <link
        rel="stylesheet"
        type={$this->getMimeType()}
        href={$this->getVersionedURL()}
      />;
  }
}
