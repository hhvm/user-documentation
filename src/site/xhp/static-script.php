<?hh // strict

use HHVM\UserDocumentation\StaticResourceMap;

final class :static:script extends :static:base {
  protected function getAllowedMimeTypes(): Set<string> {
    return Set { 'application/javascript' };
  }

  protected function render(): XHPRoot {
    return
      <script
        type={$this->getMimeType()}
        src={$this->getVersionedURL()}
      />;
  }
}
