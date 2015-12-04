<?hh // strict

use HHVM\UserDocumentation\BuildPaths;
use HHVM\UserDocumentation\APILegacyRedirectData;
use Psr\Http\Message\ResponseInterface;

require_once(BuildPaths::APIDOCS_LEGACY_REDIRECTS);

final class LegacyRedirectController extends WebController {
  public async function getResponse(): Awaitable<ResponseInterface> {
    $id = $this->getRequiredStringParam('legacy_id');
    // Since the API redirects are quite specific, see if we are redirecting
    // from there first.
    $url = idx(APILegacyRedirectData::getIndex(), $id);
    if ($url) {
      throw new RedirectException($url);
    }
    // If not, iterate through our manual redirects and see if we have
    // $from being a string part of $id. If so, then we can redirect to the
    // appropriate place.
    foreach ($this->getManualRedirectData() as $from => $to) {
      if (strpos($id, $from) !== false) {
        throw new RedirectException($to);
      }
    }
    throw new HTTPNotFoundException();
  }

  private function getManualRedirectData(): Map<string, string> {
    return Map {
      'hacklangref' => '/hack/',
      'hack.intro' => '/hack/overview/introduction',
      'hack.arrays' => '/hack/collections/introduction',
      'hack.async' => '/hack/async/introduction',
      'hack.attributes' => '/hack/attributes/introduction',
      'hack.collections' => '/hack/collections/introduction',
      'hack.constructorargumentpromotion' => '/hack/other-features/constructor-parameter-promotion',
      'hack.enums' => '/hack/enums/introduction',
      'hack.generics' => '/hack/generics/introduction',
      'hack.modes' => '/hack/typechecker/modes',
      'hack.lambda' => '/hack/lambdas/introduction',
      'hack.methoddispatch' => '/hack/',
      'hack.nullable' => '/hack/types/type-system#nullable',
      'hack.otherrulesandfeatures' => '/hack/other-features/introduction',
      'hack.predefined.interfaces' => '/hack/reference/interface/',
      'hack.shapes' => '/hack/shapes/introduction',
      'hack.traits' => '/hack/other-features/trait-and-interface-requirements',
      'hack.tuples' => '/hack/tuples/introduction',
      'hack.typealiasing' => '/hack/type-aliases/introduction',
      'hack.annotations' => '/hack/types/annotations',
      'hack.unsupported' => '/hack/unsupported/introduction',
      'hack.xhp' => '/hack/XHP/introduction',
      'hackfuncref' => '/hack/reference/',
      'book.hackcollections' => '/hack/collections/introduction',
      'intro.collections' => '/hack/collection/introduction',
      'book.enums' => '/hack/enums/introduction',
      'intro.enums' => '/hack/enums/introduction',
      'ref.enums' => '/hack/enums/functions',
      'function.hack.enums' => '/hack/enums/functions',
      'intro.hackmagic' => '/hack/callables/special-functions',
      'ref.hackmagic' => '/hack/callables/special-functions',
      'function.hack.invariant' => '/hack/types/refining#invariant',
      'function.hack.fun' => '/hack/callables/special-functions',
      'function.hack.class_meth' => '/hack/callables/special-functions',
      'function.hack.inst_meth' => '/hack/callables/special-functions',
      'function.hack.meth_caller' => '/hack/callables/special-functions',
      'book.hack.async.mysql' => '/hack/async/extensions#mysql',
      'intro.hack.async.mysql' => '/hack/async/extensions#mysql',
      'hack.async.mysql.examples' => '/hack/async/extensions#mysql',
      'book.hack.mcrouter' => '/hack/async/extensions#mcrouter',
      'intro.hack.mcrouter' => '/hack/async/extensions#mcrouter',
      'hack.mcrouter.examples' => '/hack/async/extensions#mcrouter',
      'intro.asio' => '/hack/async/utility-functions',
      'hack.ref.asio' => '/hack/async/utility-functions',
      'hack.asio.function' => '/hack/async/utility-functions',
      'install-intro' => '/hhvm/installation/introduction',
      'install-xhp' => '/hack/XHP/introduction#the-xhp-lib-library',
      'install-hack' => '/hack/typechecker/install',
    };
  }
}
