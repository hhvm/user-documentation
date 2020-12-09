<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\SilencingErrors\ErrorCodes\Infer;

class MyA {
  public function doStuff(): void {}
}

function foo(): void {
  /* HH_FIXME[4297] Cannot infer the type of $x. */
  $f = $x ==> $x->doStuff();

  $f(new MyA());
}
