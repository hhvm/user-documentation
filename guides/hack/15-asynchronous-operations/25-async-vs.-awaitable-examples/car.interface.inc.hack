<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\AsynchronousOperations\AsyncVsAwaitable\Car;

interface Car {
  // It doesn't matter to the caller how this is implemented, only that it
  // returns an Awaitable<void>
  public function drive(): Awaitable<void>;
}
