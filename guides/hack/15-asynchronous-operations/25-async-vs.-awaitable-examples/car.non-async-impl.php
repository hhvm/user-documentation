<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\AsynchronousOperations\AsyncVsAwaitable\Car;

class VolkswagenDiesel implements Car {
  public function drive(): Awaitable<void> {
    // ...
    return $this->driveNormally();
  }
  private async function driveNormally(): Awaitable<void> {
    // ...
  }
}
